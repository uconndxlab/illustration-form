<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IllustrationRequest;

class IllustrationFormController extends Controller
{
    public function viewForm() {
        return view('illustration-form');
    }

    public function storeRequest(Request $request) : RedirectResponse {
        // $request -> validate([
        //     'journal_cover' => ['required', 'boolean'],                 //enum?
        //     'description' => ['required', 'alpha_dash', 'max:500'], 
        //     'deadline' => ['required', 'boolean'], 
        //     'date' => ['date'], 
        //     'article_draft_ref' => ['image'], 
        //     'photos_ref.*' => ['image'],                                //how do the image arrays work??
        //     'add_ill_ref.*' => ['image'], 
        //     'init_ill_ref' => ['image'], 
        //     'journal_name' => ['alpha_dash', 'max:160'], 
        //     'user_name' => ['required', 'alpha_dash', 'max:100'], 
        //     'email' => ['required', 'email'], 
        //     'phone' => ['required', 'digits:10'],                       //fix
        //     'kfs_account' => ['digits:10']                              //???
        // ]);

        $formData = new IllustrationRequest();
        $formData->journal_cover_request = $request->input('journal_cover');
        $formData->description = $request->input('description');
        $formData->has_deadline = $request->input('deadline');
        $formData->date_deadline = $request->input('date');
        // $formData->article_draft_ref = $request->input('article_draft_ref');
        // $formData->photos_ref[] = $request->input('photos_ref[]');
        // $formData->add_ill_ref[] = $request->input('add_ill_ref[]');
        // $formData->init_ill_ref = $request->input('init_ill_ref');
        $formData->journal_name = $request->input('journal_name');
        $formData->name = $request->input('user_name');
        $formData->email = $request->input('email');
        $formData->phone = $request->input('phone');
        $formData->kfs_account = $request->input('kfs_account');
        $formData->reference_path = 'empty';

        $formData->save();
        return redirect()->back()->with('success', 'Request complete!');
    }
}
