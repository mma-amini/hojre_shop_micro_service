<?php

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory {
    
    protected $model = Role::class;
    
    public function definition() {
        return [
            [
                'title' => 'مشتری',
            ],
            [
                'title' => 'فروشگاه',
            ],
            [
                'title' => 'مدیر',
            ],
        ];
    }
}
