<?php
namespace App\Http\Controllers\Admin\Admin;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\AdminRequest;
use App\Http\Resources\Admin\Admin\AdminResource;
use App\Models\Admin;
use App\Traits\ResponceTrait;

class AdminController extends Controller
{
    use ResponceTrait;

    public function index()
    {
        $admins = Admin::paginate();
        return $this->sendResponce(AdminResource::collection($admins),
            'Admins retreived Successfully',
            200,
            true);
    }

    public function store(AdminRequest $request)
    {
        $admin = Admin::create($request->validated());

        return $this->sendResponce(new AdminResource($admin),
            'Admin stored Successfully');
    }

    public function show($id)
    {
        $admin = Admin::findOrFail($id);
        return $this->sendResponce(new AdminResource($admin),
            'admin retreived successfully');
    }

    public function toggleStatus($id)
    {
        $adminStatusId = auth('admin')->id();

        if ($adminStatusId == $id) {
            return $this->sendError("You can't change Status");
        }

        $admin = Admin::findOrFail($id);

        if ($admin->status == StatusEnum::Active) {
            $admin->status = StatusEnum::InActive;
        } elseif($admin->status == StatusEnum::InActive) {

              $admin->status = StatusEnum::Active;
        }

        $admin->save();
        return $this->sendResponce(new AdminResource($admin),'Status Updated Successfully');
    }
}
