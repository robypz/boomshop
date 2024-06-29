<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Http\Requests\StoreNoticeRequest;
use App\Http\Requests\UpdateNoticeRequest;
use Illuminate\Support\Facades\Storage;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notices = Notice::paginate(12);
        return view('notice.index', compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notice.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoticeRequest $request)
    {
        $notice = new Notice;
        $notice->title = $request->title;
        $notice->position = $request->position;
        if ($request->has('active')) {
            $notice->active = true;
        } else {
            $notice->active = false;
        }
        $notice->image_path = $request->file('image')->store('notices', 'public');
        $notice->save();

        return redirect()->route('notice.index', $notice)->with('success', '¡Aviso creado con éxito!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Notice $notice)
    {
        return view('notice.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notice $notice)
    {
        return view('notice.edit', compact('notice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoticeRequest $request, Notice $notice)
    {
        $notice->title = $request->title;
        $notice->position = $request->position;
        if ($request->has('active')) {
            $notice->active = true;
        } else {
            $notice->active = false;
        }
        //if request has image delete old image a save new
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($notice->image_path);
            $notice->image_path = $request->file('image')->store('/notices', 'public');
        }
        $notice->save();

        return redirect()->route('notice.index', $notice)->with('success', '¡Aviso actualizado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notice $notice)
    {
        Storage::disk('public')->delete($notice->image_path);
        $notice->delete();
        return redirect()->route('notice.index')->with('success', '¡Aviso eliminado con éxito!');
    }
}
