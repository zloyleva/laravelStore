<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\PriceType;

class UsersTableSeeder extends Seeder
{
    protected $userRoles = [
        'user',
	    'buyer',
    ];
	/**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$priceTypeArray = PriceType::all()->toArray();
        //User::truncate();

        $users = [
            ['name' => 'Admin', 'email' => 'admin@test.com', 'role' => 'admin'],
            ['name' => 'zloyleva', 'email' => 'zloyleva@gmail.com', 'role' => 'user'],

            ['name'=>'vbook2016','fname'=>'Владимир Ильич','lname'=>'Синявский','email'=>'vbook2016@mail.ru','price_type'=>3,'manager_id'=>2],
            ['name'=>'zagniy','fname'=>'Лариса Панасьевна','lname'=>'Загний','email'=>'zagniy.larisa@gmail.com','price_type'=>3,'manager_id' => 2],
            ['name'=>'okuksa','fname'=>'Оксана Валерьевна','lname'=>'Кукса','email'=>'okuksa@yandex.ru','price_type'=>3,'manager_id' => 2],
            ['name'=>'saigon-opb','fname'=>'Аделина Леонидовна','lname'=>'Парицкая','email'=>'saigon-opb@ukr.net','price_type'=>3,'manager_id' => 2],
            ['name'=>'amel4enko2017','fname'=>'Елена Григорьевна','lname'=>'Амельченко','email'=>'amel4enko2017@gmail.com','price_type'=>3,'manager_id' => 2],
            ['name'=>'dimchik4','fname'=>'Дмитрий Васильевич','lname'=>'Савчук','email'=>'dimchik4@yahoo.com','price_type'=>3,'manager_id' => 2],
            ['name'=>'shkolenko','fname'=>'Ирина Александровна','lname'=>'Школенко','email'=>'ira.shkolenko@gmail.com','price_type'=>3,'manager_id' => 2],
            ['name'=>'kniga_sklad','fname'=>'Криворожкнига','lname'=>'','email'=>'kniga_sklad@ukr.net','price_type'=>3,'manager_id' => 2],
            ['name'=>'staslaser','fname'=>'Сергей Владимирович','lname'=>'Роговский','email'=>'staslaser@meta.ua','price_type'=>4,'manager_id' => 2],
        ];

        foreach ($users as $user){
            try{
                factory(User::class)->create($user);
            }catch(Exception $e){
                print_r($user);
            }
        }
    }
}
