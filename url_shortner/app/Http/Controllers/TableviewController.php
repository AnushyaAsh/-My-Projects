<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Tableview;

class TableviewController extends Controller
{
    public function index(){
        $shortUrl= Tableview::latest()->get();
        return view('tableview.index',compact('shortUrl'));
    }
    public function store( Request $request){ 
         $data = $request->validate([
            'original_url'=>'required|url'
           ]);
           $input['original_url'] = $request->original_url;
           $input['shorterned_url'] = Str::random(6);

           Tableview::create($input);

           return redirect('tableview.index')->withSuccess('Shorten Link Generated successfully');
    }
    public function shortLink($shorternedurl){

       $find= Tableview::where('shorterned_url',$shorternedurl)->first();
        
       if ($find) {
        return redirect($find->original_url);
    } else {
        return redirect()->back()->withErrors(['Short URL not found']);
    }

    }
    public function edit($id)
    {
        $shortUrl = Tableview::findOrFail($id);
        return view('tableview.edit', compact('shortUrl'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'original_url' => 'required|url'
        ]);
    
        $shortUrl = Tableview::findOrFail($id);
        $shortUrl->update($request->all());
    
        return redirect()->route('generate.tableview.index.post')->withSuccess('URL updated successfully');
    }

    public function destroy($id)
    {
        $url = Tableview::where('id',$id)->firstOrFail();
        $url->delete();

        return redirect('tableview')->with('status','URL deleted successfully');
    }
    
    }

