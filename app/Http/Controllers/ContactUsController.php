<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\BusinessexContact;

class ContactUsController extends Controller
{
    /**
     * Handle contact form submission.
     */
    public function submitContactForm(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'contact_name'    => 'required|string|max:100',
            'contact_email'   => [
                'required',
                'email',
                function (string $attribute, mixed $value, \Closure $fail): void {
                    if (preg_match('/@(example\.com|test\.com|sample)$/i', (string) $value)) {
                        $fail('Please provide a valid contact email address.');
                    }
                },
            ],
            'contact_mobile'  => 'required|regex:/^[56789][0-9]{9}$/|max:12',
            'contact_comment' => 'required|string|min:15|max:150',
            //'subscribe'       => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Save to database
        BusinessexContact::create([
            'contact_name'    => $request->contact_name,
            'contact_email'   => $request->contact_email,
            'contact_mobile'  => $request->contact_mobile,
            'contact_comment' => $request->contact_comment,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Thank you! Your message has been sent successfully.');
    }
}