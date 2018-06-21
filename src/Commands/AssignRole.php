<?php

namespace Spatie\Permission\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Contracts\Role as RoleContract;
use Spatie\Permission\Exceptions\ModelDoesNotSupportRoles;

class AssignRole extends Command
{
    protected $signature = 'permission:assign-role
        {name : The name of the role}
        {model_id : ID of the assignee model}
        {model_class=user : Assignee model type. }';

    protected $description = 'Assign a role to a user';

    public function handle()
    {
        $modelClass = sprintf("App\%s",ucfirst($this->argument('model_class')));

        if(! method_exists($modelClass,'assignRole'))
            throw ModelDoesNotSupportRoles::create($modelClass);

        $roleClass = app(RoleContract::class);
        

        $role = $roleClass::where('name',$this->argument('name'))->firstOrFail();

        $model = $modelClass::findOrFail($this->argument('model_id'));

        // $model->assignRole($role);

        $this->info("Role `{$role->name}` assigned to `{$modelClass}`.`{$model->id}`");
    }
}