<?php

namespace App\Http\Controllers;

use App\Models\Notify;
use App\Http\Controllers\BaseController as BaseController;
use App\Http\Requests\StoreNotifyRequest;
use App\Http\Requests\UpdateNotifyRequest;
use Auth;

class NotifyController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifies = Auth::user()->Notifies;
        return $this->sendResponse($notifies, 'Thanh cong');
    }

    public function updateIsRead()
    {
        $notifies = Auth::user()->Notifies;

        foreach ($notifies as $item) {
            if ($item->isRead == false) {
                $item->fill([
                    'isRead' => true
                ]);
                $item->save();
            }
        }

        return $this->sendResponse($notifies, 'Thanh cong');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNotifyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNotifyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notify  $notify
     * @return \Illuminate\Http\Response
     */
    public function show(Notify $notify)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notify  $notify
     * @return \Illuminate\Http\Response
     */
    public function edit(Notify $notify)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNotifyRequest  $request
     * @param  \App\Models\Notify  $notify
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNotifyRequest $request, Notify $notify)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notify  $notify
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notify $notify)
    {
        //
    }
}
