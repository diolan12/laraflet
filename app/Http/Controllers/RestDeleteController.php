<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class RestDeleteController extends BaseRest
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
    }
    public function delete(Request $request, $table, $id)
    {
        parent::__construct($request, $table);
        if ($this->model != null) {
            $entity = $this->model->find($id);

            if ($request->has('file')) {
                $fileRow = $request->input('file');
                $isDeleted = unlink(project_path(public_path . $entity->$fileRow));
            }

            if ($request->has('force')) {
                $this->code = ($entity->forceDelete()) ? 200 : 422;
            } else {
                $entity->deleted_at = Carbon::now('UTC');
                $this->code = ($entity->save()) ? 200 : 422;
            }

            $this->json = $entity;
        }
        return $this->response();
    }

    public function restore(Request $request, $table, $id)
    {
        parent::__construct($request, $table);
        if ($this->model != null) {
            // $data = $this->validate($request, $this->model->validation());
            $data['deleted_at'] = null;
            // $data = $this->model->filter($data);

            $this->code = ($this->model->onlyTrashed()->where('id', $id)->update($data)) ? 200 : 422;
            $this->json = $this->model->get();
        }
        return $this->response();
    }
}