<?php

namespace App\Http\Controllers;

use App\Model\Project;
use App\Model\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        if( Auth::check() ){
            $company=[];
            $companies = Company::all();
            return view('company.index', ['companies'=>$companies, 'company'=>$company]);
        }
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       // return 'Company Created';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()){
            $company = Company::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'user_id' => Auth::user()->id
            ]);
            if($company){
                return redirect()->route('company.index', ['company'=> $company->id])
                ->with('success' , 'Company created successfully');
            }
        }
        
        return back()->withInput()->with('errors', 'Error creating new company');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        if( Auth::check() ){
            $companay=Company::find($company->id);
            return view('company.show',  ['company'=>$company]);
        }
        return view('auth.login');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        if( Auth::check() ){
            $companies = Company::all();
            $company=Company::find($company->id);
            return view('company.index',  ['company'=>$company, 'companies'=>$companies]);
        }
        return view('auth.login');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        if( Auth::check() ){
            $companyUpdate=Company::where('id', $company->id)->update([
                'name'=>$request->input('name'),
                'description'=>$request->input('description'),
            ]);
            
            if($companyUpdate){
                return redirect()->route('company.index', ['company'=>$company->id])
                ->with('success' , "Department Updated successfully");
            }
        }
        return view('auth.login');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
