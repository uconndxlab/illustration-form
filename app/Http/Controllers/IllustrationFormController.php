<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use App\Models\IllustrationRequest;
use Illuminate\Support\Facades\Storage;

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
            'article_draft_ref' => ['image', 'max:2500'],       //current max size per file is 5 MB - set in php.ini
            'photos_ref.*' => ['image', 'max:2500'],
            'add_ill_ref.*' =>['image', 'max:2500'],
            'init_ill_ref' => ['image', 'max:2500'],
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

        //handling for reference images
        if ($request->hasFile('article_draft_ref') || $request->hasFile('photos_ref') || $request->hasFile('add_ill_ref') || $request->hasFile('init_ill_ref')) {
            $formData->has_references = TRUE;
            $formData->save();
            //get id
            $id = $formData->id;
            //build the path and make directory
            $refPath = 'request-id-'.$id;
            $formData->reference_path = $refPath;

            //uploading the files - location and naming
            if ($request->hasFile('article_draft_ref')) {
                $file = $request->file('article_draft_ref');
                $file->storeAs('illustrationReferences/'.$refPath, 'articleDraft-'.$id.'.'.$file->extension());
            }
            if ($request->hasFile('photos_ref')) {
                $count = 1;
                foreach ($request->file('photos_ref') as $file) {
                    $file->storeAs('illustrationReferences/'.$refPath, 'photosContentStyle-'.$id.'-'.$count.'.'.$file->extension());
                    $count++;
                }
            }
            if ($request->hasFile('add_ill_ref')) {
                $count = 1;
                foreach ($request->file('add_ill_ref') as $file) {
                    $file->storeAs('illustrationReferences/'.$refPath, 'additionalIllustrations-'.$id.'-'.$count.'.'.$file->extension());
                    $count++;
                }
            }
            if ($request->hasFile('init_ill_ref')) {
                $file = $request->file('init_ill_ref');
                $file->storeAs('illustrationReferences/'.$refPath, 'initialIllustration-'.$id.'.'.$file->extension());
            }
        }
        else {
            $formData->has_references = FALSE;
        }

        //save request to database
        $formData->save();
        return redirect()->route('illform.view')->with('success', 'Request complete!');

        //how do we want to limit size - number of images? size of images? size of post?
    }
}
