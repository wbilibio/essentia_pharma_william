<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Entities\Clients;
use Image;
use Validator;
use Session;
use Redirect;
use Input;
use File;


class ClientsController extends Controller
{
    protected $files_path = '_files/clients/';
    protected $files_path_save = '../_files/clients/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Clients::orderBy('order', 'desc')->get();
        return view('clients.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.form');
    }

    public function sortable(Request $request)
    {
        $this->doReorder($request->input('items'), true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'email|required|max:255',
            'phone' => 'required|max:255',
            'img_file' => 'required|image|max:255'
        ]);

        $item = new Clients;
        $item->name = $request->input('name');
        $item->email = $request->input('email');
        $item->phone = $request->input('phone');
        $item->order = count(Clients::All()) + 1;

        $image = $this->doUpload($request->file('img_file'));
        $item->image = $image;
        $item->save();

        Session::flash('success', 'Item salvo com sucesso!');
        return Redirect::to('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Clients::find($id);
        return view('clients.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Clients::find($id);

        if(isset($item)) {
            $item->delete();
            File::delete($this->files_path.$item->image);
            $this->doReorder();
            Session::flash('success', 'Item removido com sucesso!');
        } else
            Session::flash('error', 'O item que você tentou remover não existe!');

        return Redirect::to('/');
    }
    public function destroyImage($id)
    {
        $item = Clients::find($id);

        if(isset($item)) {
            File::delete($this->files_path.$item->image);
            $item->image = '';
            $item->save();
            Session::flash('success', 'Item removido com sucesso!');
        } else
            Session::flash('error', 'O item que você tentou remover não existe!');
        return Redirect::to('/clientes/'.$id.'/editar');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'email|required|max:255',
            'phone' => 'required|max:255',
            'img_file' => 'required|image|max:255'
        ]);

        $item = Clients::find($id);
        $item->name = $request->input('name');
        $item->email = $request->input('email');
        $item->phone = $request->input('phone');
        if (Input::hasFile('img_file'))
        {
            $image = $this->doUpload($request->file('img_file'));
            File::delete($this->files_path.$item->image);
            $item->image = $image;
        }

        $item->save();

        Session::flash('success', 'Item editado com sucesso!');
        return Redirect::to('/');
    }
    protected function doUpload($file) {
        if ($file->isValid()) {
            if(!File::exists($this->files_path)) $result = File::makeDirectory($this->files_path, 0777, true);

            $filename  = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = public_path($this->files_path . $filename);

            Image::make($file->getRealPath())->save($path);

            return $filename;
        }
    }
    protected function doReorder($items = [], $grid = false) {
        if(count($items) == 0) $items = Clients::orderBy('order', 'desc')->get();
        $order = count($items);

        foreach($items as $item){
            $item = Clients::find($grid ? $item['id'] : $item->id);
            $item->order = $order;
            $item->save();
            $order--;
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

}
