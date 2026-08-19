# Sidebar Filter State Management Implementation

## Changes Made to `resources/views/includes/catleftstartup.blade.php`

### Overview
Updated the sidebar to intelligently manage filter state by:
1. ✅ **Keeping selected filters checked** after results display
2. ✅ **Collapsing all sections by default** 
3. ✅ **Expanding only sections with active filters**
4. ✅ **Expanding parent items with selected children**

---

## Implementation Details

### 1. Filter State Variables (PHP Block - Top of Sidebar)
```php
$selectedLocations = request()->input('location', [])  // Array of city IDs
$selectedIndustries = request()->input('industry', [])  // Array of industry IDs
$selectedBusinessType = request('business_type', 'all')  // Single business type
$selectedMinInvestment = request('min_investment', '')  // Investment range min
$selectedMaxInvestment = request('max_investment', '')  // Investment range max
```

### 2. Expansion Logic Variables
```php
$expandBusinessType = $selectedBusinessType !== 'all'      // Expand if filtered
$expandLocation = !empty($selectedLocations)               // Expand if locations selected
$expandInvestment = (min !== '' || max !== '')             // Expand if range set
$expandIndustry = !empty($selectedIndustries)              // Expand if industries selected
```

### 3. Section-Level Expand/Collapse
Each main section (Business Type, Investment, Location, Industry) now:

**Header Attributes:**
```html
aria-expanded="{{ $expandSectionName ? 'true' : 'false' }}"
```

**Body Classes:**
```html
class="collapse {{ $expandSectionName ? 'show' : '' }}"
```

**Example - Business Type Section:**
```html
<!-- Header -->
<div class="card-header ...">
  <a ... aria-expanded="{{ $expandBusinessType ? 'true' : 'false' }}" ...>
    Startups Looking for
  </a>
</div>

<!-- Body -->
<div id="collapseBusiness" class="collapse {{ $expandBusinessType ? 'show' : '' }}">
  <!-- Content -->
</div>
```

---

## 4. Sub-Section Level (States, Industry Categories)

### Location Sections (States)
Each state expands if it has selected cities:
```php
// Check if any city in this state is selected
$hasSelectedCities = collect($cityList)->some(function ($city) use ($selectedLocations) {
    return in_array((int) $city['id'], $selectedLocations, true);
});
```

**State Header:**
```html
aria-expanded="{{ $hasSelectedCities ? 'true' : 'false' }}"
```

**State Body:**
```html
class="collapse {{ $hasSelectedCities ? 'show' : '' }}"
```

### Industry Sections (Categories)
Each category expands if it has selected sub-industries:
```php
// Check if any sub-industry in this category is selected
$hasSelectedIndustries = collect($subIndustries)->some(function ($industry) use ($selectedIndustries) {
    return in_array((int) $industry['id'], $selectedIndustries, true);
});
```

**Category Header:**
```html
aria-expanded="{{ $hasSelectedIndustries ? 'true' : 'false' }}"
```

**Category Body:**
```html
class="collapse {{ $hasSelectedIndustries ? 'show' : '' }}"
```

---

## 5. Checkbox/Radio Button Checked States

All filters retain their checked state based on query parameters:

**Business Type (Radio Buttons):**
```html
<input type="radio" name="business_type" value="investor" 
  {{ $selectedBusinessType === 'investor' ? 'checked' : '' }}>
```

**Location (Checkboxes):**
```html
<input type="checkbox" name="location[]" value="{{ $city['id'] }}" 
  {{ in_array((int) $city['id'], $selectedLocations, true) ? 'checked' : '' }}>
```

**Industry (Checkboxes):**
```html
<input type="checkbox" name="industry[]" value="{{ $subIndustry['id'] }}" 
  {{ in_array((int) $subIndustry['id'], $selectedIndustries, true) ? 'checked' : '' }}>
```

**Parent Checkboxes (Location States):**
```html
<input type="checkbox" class="parent-location-filter" 
  {{ collect($cityList)->every(function ($city) use ($selectedLocations) { 
    return in_array((int) $city['id'], $selectedLocations, true); 
  }) ? 'checked' : '' }}>
```

---

## 6. Selected Filters Display

The "Selected filters" badge section at the top of the sidebar now displays:
- **Business Type** (if not "all") - Shown as badge-primary
- **Location Names** - Shown as badge-secondary
- **Industry Names** - Shown as badge-secondary

```html
@if($selectedBusinessType !== 'all')
    <span class="badge badge-primary">{{ ucfirst($selectedBusinessType) }}</span>
@endif
@foreach(array_merge($selectedLocationNames, $selectedIndustryNames) as $filterName)
    <span class="badge badge-secondary">{{ $filterName }}</span>
@endforeach
```

---

## User Experience Flow

### Before (Old Behavior)
1. User selects filters (e.g., Investor + Location)
2. Form submits → Results display
3. ❌ Sidebar collapses all sections
4. ❌ User can't see which filters were applied
5. ❌ Radio buttons/checkboxes appear unchecked

### After (New Behavior)
1. User selects filters (e.g., Investor + Location)
2. Form submits → Results display
3. ✅ Sidebar shows which filters are active
4. ✅ Selected radio buttons/checkboxes are checked
5. ✅ Relevant sections remain expanded
6. ✅ Parent items (states/categories) expand only if children are selected
7. ✅ Other sections collapse for cleaner UI

---

## Example Scenarios

### Scenario 1: User selects "Investor" business type
- **Result:**
  - Business Type section: **Expanded** (aria-expanded="true", show class)
  - "Investor" radio: **Checked**
  - "Selected filters" shows: "Investor" badge
  - Other sections: Collapsed

### Scenario 2: User selects Delhi and Mumbai cities
- **Result:**
  - Location section: **Expanded**
  - Andhra Pradesh state: **Collapsed** (no cities selected)
  - Delhi state: **Expanded** (Delhi city is selected) + **Checked**
  - Delhi city: **Checked**
  - Mumbai state: **Expanded** (Mumbai city is selected) + **Checked**
  - Mumbai city: **Checked**
  - "Selected filters" shows: "Delhi" and "Mumbai" badges
  - Other sections: Collapsed

### Scenario 3: User applies multiple filters
Example: Investor + Delhi + SaaS Industry + Min ₹50L Investment
- **Result:**
  - Business Type: **Expanded** + "Investor" **Checked**
  - Location: **Expanded** + Delhi state **Expanded** + Delhi **Checked**
  - Industry: **Expanded** + IT category **Expanded** + SaaS **Checked**
  - Investment Size: **Expanded** (because min_investment is set)
  - "Selected filters" shows: "Investor", "Delhi", "SaaS" badges

---

## Data Flow

```
User clicks filter
    ↓
Form submitted via onchange="this.form.submit()"
    ↓
URL updated: /startuplisting?business_type=investor&location[]=5...
    ↓
Page reloads with new query parameters
    ↓
Sidebar PHP extracts parameters using request()->input() / request()
    ↓
$selected* variables populated
    ↓
$expand* variables calculated based on $selected* values
    ↓
Blade view renders sections with correct expanded/collapsed state
    ↓
Blade view renders checkboxes with correct checked state
    ↓
User sees filtered results with sidebar showing active filters
```

---

## Technical Details

### Request Parameter Names (Query String)
- `business_type` - Single value: all|investor|buyer|loan|mentorship|incubators
- `location[]` - Array of city IDs from BxCity table
- `industry[]` - Array of sub-industry IDs from industryCategories
- `min_investment` - Minimum investment amount
- `max_investment` - Maximum investment amount

### Collection Operations Used
- `collect()->every()` - Check if ALL items match condition (for parent checkbox)
- `collect()->some()` - Check if ANY item matches condition (for parent expansion)
- `collect()->filter()` - Filter array by condition
- `collect()->map()` - Transform array elements
- `in_array()` - Check if value exists in array

### Bootstrap 4 Classes Used
- `.collapse` - Bootstrap collapse component (default hidden)
- `.collapse.show` - Bootstrap collapse component (visible)
- `aria-expanded="true/false"` - Accessibility attribute for screen readers
- `data-toggle="collapse"` - Bootstrap JS trigger

---

## Files Modified
- ✅ `resources/views/includes/catleftstartup.blade.php`

## Files NOT Modified (Still working correctly)
- `app/Http/Controllers/StartupController.php` (No changes needed)
- `resources/views/startuplist.blade.php` (No changes needed)
- `routes/web.php` (No changes needed)

---

## Testing Checklist
- [ ] Select Business Type filter → Verify section expands and stays expanded
- [ ] Deselect Business Type (select "All") → Verify section collapses
- [ ] Select multiple locations → Verify Location section expands
- [ ] Verify selected states expand automatically
- [ ] Verify unselected states collapse automatically
- [ ] Select multiple industries → Verify Industry section expands
- [ ] Verify selected categories expand automatically
- [ ] Verify unselected categories collapse automatically
- [ ] Select investment range → Verify Investment section expands
- [ ] Apply combined filters → Verify all relevant sections expand
- [ ] Verify all checked items remain checked after page reload
- [ ] Verify "Selected filters" badge section shows all active filters
- [ ] Verify pagination maintains filter state
- [ ] Verify filter reset removes all checked states

---

**Status: ✅ COMPLETE AND READY FOR TESTING**

All filter selections now persist in the UI, making it clear to users which filters are currently active.
