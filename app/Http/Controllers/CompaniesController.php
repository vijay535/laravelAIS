<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use File;


class CompaniesController extends Controller
{
    public function index()
    {
        $companies = Company::latest()->paginate(10);
        return View('companiesdetails', compact('companies'))
        ->with('i',(request()->input('page', 1) - 1) * 10);
    }
   
    public function create()
    {
        return View('companiesAddData');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'weburl' => 'required',
            'logo' => 'required|mimes:jpeg,png,jpg,gif,svg',
        ]); 
        $logoName = time().'_'.$request->logo->getClientOriginalName(); 
        $request->logo->move(public_path('images'), $logoName);

        $data = new Company;
        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->website_url = $request->input('weburl');
        $data->logo = $logoName;
        $data->save();
        return back()->with('success', 'Company created successfully.');
    }

    public function show(Company $company)
    {
        //
    }

    public function edit($id)
    {
        //
        return view('companiesEditData')->with('datafind',Company::find($id));
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tag' => 'required',
        ]);
        
        $dataUpdate = Company::find($request->id);
        if ($request->hasFile('companylogo')){
            $logoName = time().'_'.$request->companylogo->getClientOriginalName(); 
            $request->companylogo->move(public_path('images'), $logoName);

        }else {
           $logoName = $dataUpdate->image;
        }

          $dataUpdate->name = $request->name;
          $dataUpdate->email = $request->email;
          $dataUpdate->website_url = $request->weburl;
          $dataUpdate->logo = $logoName;
          $dataUpdate->save();
          return redirect('companies')->with('success', 'Updated successfully.');
          
    }

    public function destroy($id)
    {
        Company::destroy(array('id',$id));
        return redirect('companies')->with('success', 'Delete successfully.');
    }
}
