<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use App\Models\IllustrationRequest;

class IllustrationFormController extends Controller
{
    public function viewForm() {
        return view('illustration-form');
    }

    public function storeRequest(Request $request) : RedirectResponse {
        $request -> validate([
            'journal_cover' => ['required', 'in:no_paid,yes_free'],
            'description' => ['required', 'string', 'max:1000'],
            'deadline' => ['required', 'boolean'],
            'date' => [
                Rule::requiredIf(function () use ($request) {
                    return $request->input('deadline');
                }), 'nullable', 'date'],
            'article_draft_ref' => ['image'],
            'photos_ref.*' => ['image'],
            'add_ill_ref.*' =>['image'],
            'init_ill_ref' => ['image'],
            'journal_name' => ['nullable', 'string', 'max:160'],
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'digits:10'],           //to adjust later
            'kfs_account' => [
                Rule::requiredIf(function () use ($request) {
                    return ($request->input('journal_cover') == 'no_paid');
                }),'nullable', 'digits:10'],                            //do not really know what valid KFS is
        ]);

        //data from form
        $formData = new IllustrationRequest();
        $formData->is_journal_cover_request = $request->input('journal_cover');
        $formData->journal_name = $request->input('journal_name');
        $formData->description = $request->input('description');
        $formData->has_deadline = $request->input('deadline');
        $formData->date_deadline = $request->input('date');
        $formData->name = $request->input('name');
        $formData->email = $request->input('email');
        $formData->phone = $request->input('phone');
        $formData->kfs_account = $request->input('kfs_account');
        
        //reference image handling
        $formData->has_references = 'False';
        $formData->reference_path = '';

        $formData->save();
        return redirect()->route('illform.view')->with('success', 'Request complete!');
    }
}
