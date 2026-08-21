# Application Test Cases

This document records the PHPUnit coverage for the main public workflows and the manual or integration checks that should be completed before release.

## Test Environment

- Framework: Laravel 12
- Test runner: PHPUnit 11
- PHP: 8.2 or newer
- Database: SQLite in-memory, configured by `phpunit.xml`
- Mail: array transport in tests
- Queue: synchronous
- Recommended Windows PHP executable: `C:\xampp\php\php.exe`

Run the automated suite:

```powershell
C:\xampp\php\php.exe artisan test
```

Run only the workflow suite:

```powershell
C:\xampp\php\php.exe vendor/bin/phpunit tests/Feature/ApplicationWorkflowTest.php --testdox
```

## Automated Test Cases

Implemented in `tests/Feature/ApplicationWorkflowTest.php`.

| ID | Area | Scenario | Expected result |
|---|---|---|---|
| AW-001 | Listing | Business, investor, mentor, and startup listing requests include filter parameters | Each endpoint returns a successful response |
| AW-002 | Listing | Listing requests include search/location/industry and sorting parameters | Query parameters are accepted without server errors |
| AW-003 | Contact action | Guest opens business, investor, mentor, or startup listing | Rendered listing contains the shared `#login` modal target |
| AW-004 | Profile validation | Empty business profile submission | Redirects back with validation errors |
| AW-005 | Profile validation | Empty investor profile submission | Redirects back with validation errors |
| AW-006 | Profile validation | Empty lender profile submission | Redirects back with validation errors |
| AW-007 | Profile validation | Empty mentor profile submission | Redirects back with validation errors |
| AW-008 | Profile validation | Empty startup profile submission | Redirects back with validation errors |
| AW-009 | Contact Us validation | Missing name, invalid email/mobile, and short comment | Redirects back with field errors |
| AW-010 | Contact Us persistence | Valid name, email, mobile, and comment | Redirects with success message and saves a contact record |
| AW-011 | Newsletter validation | Invalid AJAX newsletter payload | Returns HTTP 422 with JSON validation errors |
| AW-012 | Newsletter account check | Valid newsletter payload for an unknown email | Returns HTTP 404 with `User does not exist` |
| AW-013 | Detail routes | Authenticated user requests missing business, investor, mentor, or startup profile | Returns HTTP 404 rather than exposing an invalid profile |
| AW-014 | Newsletter success | Existing user submits a valid newsletter subscription | Returns HTTP 200 and stores a pending subscription |
| AW-015 | Login validation | Existing user submits an incorrect password | Redirects with login error and remains unauthenticated |
| AW-016 | Login success | Existing user submits valid credentials | Redirects to dashboard and authenticates the session |
| AW-017 | Quick registration validation | Empty quick-registration payload | Redirects with required-field errors |
| AW-018 | Quick registration success | Valid quick-registration payload | Creates the user, redirects with success, and sends verification mail |
| AW-019 | Logout | Authenticated user logs out | Redirects home and clears the session |

## Profile Submission Validation Matrix

These rules should be retained as regression cases when profile controllers change.

### Business

- Required: name, email, mobile, designation, advertisement headline, introduction.
- Email format and maximum length.
- Numeric financial fields reject non-numeric input.
- Website and team email fields reject invalid email/URL values.
- Establishment year must be a valid year from 1900 through the current year.
- Array fields must contain valid strings or emails.
- Valid data creates the business profile and related profile data.

### Investor

- Required: name, email, mobile, location, investor type.
- Email must be unique in `profile_investor.inv_email`.
- Investor type accepts only Individual Investor or Investment Firm.
- LinkedIn must be a valid URL when supplied.
- Location and sector preference arrays must contain valid IDs/formats.
- Investment and acquisition amounts must be numeric and non-negative.
- Unauthenticated submission is rejected by the controller.
- Valid authenticated data creates the investor profile and preferences.

### Lender

- Required: name, email, mobile, location, headline, introduction, lender type.
- Lender type accepts only Private Lender or NBFC Personnel.
- Email must be unique in `profile_lenders.lender_email`.
- Interest rate must be numeric from 0 through 100.
- Profile picture accepts only configured image types and size.
- Valid authenticated data creates lender, user-profile, location, and sector records.

### Mentor

- Required: mentor name, mobile, and email.
- Email must be valid, bounded, and unique.
- LinkedIn must be a valid URL when supplied.
- Occupation and profile text respect their maximum lengths.
- Experience and sector arrays are stored against the created mentor.
- Valid data creates the mentor profile and preference records.

### Startup

- Required: name, email, mobile, designation, headline, introduction, entity name, business type, industry, establishment year, employees, address, pin code, and one-line pitch.
- Establishment year must be between 1900 and the current year.
- Financial and funding values must be numeric and non-negative.
- Website and social links must be valid URLs.
- Uploads enforce configured file types and size limits.
- Team arrays validate member names, designations, and emails.
- Stake and interest-rate values enforce their numeric ranges.
- Valid data creates startup, user-profile, management, fundraising, and image records.

## Listing, Search, Filter, and Sorting Cases

These cases should be run with seeded active and inactive records for each profile type.

1. Default listing returns active records only.
2. Empty result displays the no-results state.
3. Business type filter returns only records matching investor, buyer, loan, mentorship, or incubator criteria.
4. Location filter supports one and multiple locations.
5. Industry filter supports one and multiple industries.
6. Investment minimum excludes records below the lower bound.
7. Investment maximum excludes records above the upper bound.
8. Investor state, city, investor type, and investment range filters combine correctly.
9. Mentor state, city, occupation, and sorting filters combine correctly.
10. Startup business type, location, industry, and investment filters combine correctly.
11. Business, investor, and mentor ascending sorting is stable and preserves filters.
12. Descending sorting is stable and preserves filters.
13. Pagination preserves all active query parameters.
14. Invalid numeric filter input does not cause a server error.
15. Detail URLs use the selected profile ID and return 404 for inactive or missing records.

## Authentication and Contact-Action Cases

1. Guest sees the login modal target when clicking Contact Business.
2. Guest sees the login modal target when clicking Send Proposal for an investor.
3. Guest sees the login modal target when clicking Send Proposal for a mentor.
4. Guest sees the login modal target when clicking Contact Startup.
5. Authenticated user is sent to the selected detail page.
6. Invalid profile IDs return 404 for authenticated users.
7. Login with valid credentials regenerates the session and redirects to the dashboard.
8. Invalid login credentials return validation/session errors.
9. Empty login payload returns validation errors.
10. Quick registration requires profile, name, mobile, and email.
11. Valid quick registration creates a user and sends verification mail.
12. Logout invalidates the session and redirects home.
13. Login modal opens correctly in a browser with Bootstrap JavaScript loaded.

## Contact Us Cases

1. Required fields reject empty input.
2. Email rejects malformed addresses and blocked example/test/sample domains.
3. Mobile accepts ten-digit numbers beginning with 5, 6, 7, 8, or 9.
4. Mobile rejects letters, short values, and disallowed prefixes.
5. Comment requires 15 to 150 characters.
6. Valid data is persisted in `businessex_contactus`.
7. Success flash message is shown after a valid submission.
8. Previous input is retained after validation failure.

## Newsletter Cases

1. AJAX validation returns HTTP 422 JSON errors.
2. Non-AJAX validation redirects back with errors.
3. Unknown email returns HTTP 404 and does not subscribe.
4. Existing user receives a successful subscription response.
5. Existing user subscription is idempotent.
6. Invalid phone numbers are rejected.
7. Invalid email addresses are rejected.
8. Required name and city fields are enforced.

## Manual and Integration Coverage

The automated suite intentionally does not call external systems. Complete these checks in a staging environment:

- Browser click test for each login modal and authenticated detail navigation.
- Mail delivery for profile creation, contact, verification, and newsletter flows.
- S3 upload and image URL rendering for profile images/documents.
- Payment success, cancellation, and failure callbacks.
- Authenticated dashboard CRUD for business, investor, lender, mentor, and startup profiles.
- CSRF protection and session expiration.
- Mobile responsive behavior and pagination controls.
- MySQL migration run, because production uses MySQL-specific column alterations while PHPUnit uses SQLite.

## Known Test Infrastructure Notes

- Shared view data is loaded by `AppServiceProvider`; optional table queries are guarded so isolated test databases can boot.
- MySQL-only column alteration migrations skip SQLite, where the initial schema already has the required compatible type.
- Tests should use the XAMPP PHP executable on Windows when `php` is not on `PATH`.
