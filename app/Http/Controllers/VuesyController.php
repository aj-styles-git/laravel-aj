<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;


class VuesyController extends Controller
{
    //
    public function index(Request $request){
        if(view()->exists($request->path())){
            return view($request->path());
        }
        return view('pages-404');
    }

    public function home(){
        if (!Auth::guard('web')->check()) {
            return view('auth.login');
        }else{
            return route('all_institutes',["lang"=>app()->getLocale()]);


        }
    }
    public function uimodals(){
        return view('ui-modals');
    }
    
    public function login(){
       
      
        if (!Auth::guard('web')->check()) {
            return view('auth.login');
        }else{
            return redirect()->route('all_institutes',["lang"=>app()->getLocale()]);


        }
       
    }

    public function register(){
        return view('auth.register');
    }

    public function tablesAdvanced(){
        return view('tables-advanced');

    }

    public function tablesBasic(){
        return view('tables-basic');

    }
    public function formElements(){
        return view('form-elements');

    }
    public function formAdvanced(){
        return view('form-advanced');

    }
    public function formWizard(){
        return view('form-wizard');

    }
    public function layoutVertical(){
        return view('layout-vertical');

    }
    public function uiButtons(){
        return view('ui-buttons');

    }
    public function mapsGoogle(){
        return view('maps-google');

    }
    public function extendedSweetAlert(){
        return view('extended-sweet-alert');

    }
    public function formvalidation(){
        return view('form-validation');

    }
    public function uiutilities(){
        return view('ui-utilities');

    }
    public function iconsunicons(){
        return view('icons-unicons');

    }
    public function iconsmaterialdesign(){
        return view('icons-materialdesign');

    }
    public function pricingbasic(){
        return view('pricing-basic');

    }
    public function appskanbanboard(){
        return view('apps-kanban-board');

    }
    public function pricingtable(){
        return view('pricing-table');

    }
    public function iconsfontawesome(){
        return view('icons-fontawesome');

    }
    public function invoicesdetail(){
        return view('invoices-detail');

    }
    public function pagesprofile(){
        return view('pages-profile');

    }

    public function error404cover(){
        return view('error-404-cover');

    }
    public function contactslist(){
        return view('contacts-list');

    }
    public function authresetpasswordcover(){
        return view('auth-resetpassword-cover');

    }
    public function authforgotpasswordcover(){
        return view('auth-forgotpassword-cover');

    }
    public function forgetPassword(){
        return view('auth.forget_password');

    }
    public function authforgotpasswordbasic(){
        return view('auth-forgotpassword-basic');

    }
    public function chartsline(){
        return view('charts-line');

    }
    public function contactssettings(){
        return view('contacts-settings');

    }
    public function contactsgrid(){
        return view('contacts-grid');

    }
    public function ecommerceorders(){
        return view('ecommerce-orders');

    }
    public function ecommercecart(){
        return view('ecommerce-cart');

    }
    public function uicards(){
        return view('ui-cards');

    }
    public function extendedlightbox(){
        return view('extended-lightbox');

    }
    public function invoiceslist(){
        return view('invoices-list');

    }
    public function iconsboxicons(){
        return view('icons-boxicons');

    }
    public function ecommerceproductdetail(){
        return view('ecommerce-product-detail');

    }
    
    public function logout(){
     
        Session::flush();

        // Regenerate session ID
        Session::regenerate();
        
        // Redirect back to the login page
        return Redirect::route('login');


    }


}
