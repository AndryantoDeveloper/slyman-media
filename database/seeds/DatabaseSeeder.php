<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Permission;
use App\Brand;
use App\Gadget;
use App\Device;
use App\Color;
use App\Carrier;
use App\Size;
use App\Condition;
use App\Model;

class DatabaseSeeder extends Seeder
{

    public function dummy(){
        $string = file_get_contents(public_path('data_iphone.json'));
        $json = json_decode($string, true);
        $data = $json["data"];
        $sizeArr = count($data);

        for($i=0;$i<$sizeArr;$i++){

            // Brand
            $brand = null;
            $_brand = Brand::findBy("name",$data[$i]["Brand"]);
            if($_brand){
                $brand = $_brand;
            }else{
                $brand = Brand::create([
                    "name"=>$data[$i]["Brand"],
                    "description"=>""
                ]);
            }

            // Gadget
            $gadget = null;
            $_gadget = Gadget::findBy("gadget_id",$data[$i]["Gadget_ID"]);
            if($_gadget){
                $gadget = $_gadget;
            }else{
                $gadget = Gadget::create([
                    "gadget_id"=>$data[$i]["Gadget_ID"],
                    "name"=>$data[$i]["Gadget_Name"],
                    "brand_id"=>$brand->id,
                    "description"=>""
                ]);
            }

            // Color
            $color = null;
            $_color = Color::findBy("name",$data[$i]["Color"]);
            if($_color){
                $color = $_color;
            }else{
                $color = Color::create([
                    "name"=>$data[$i]["Color"],
                    "description"=>""
                ]);
            }

            // Carrier
            $carrier = null;
            $_carrier = Carrier::findBy("name",$data[$i]["Carrier"]);
            if($_carrier){
                $carrier = $_carrier;
            }else{
                $carrier = Carrier::create([
                    "name"=>$data[$i]["Carrier"],
                    "description"=>""
                ]);
            }

            // Size
            $size = null;
            $temp = explode("GB", $data[$i]["Size"]);
            $_size = Size::findBy("value",$temp[0]);
            if($_size){
                $size = $_size;
            }else{
                $size = Size::create([
                    "value"=>$temp[0],
                    "unit"=>"GB"
                ]);
            }


            // Model
            $model = null;
            $_model = Model::findBy("name",$data[$i]["Device_Name"]);
            if($_model){
                $model = $_model;
            }else{
                $model = Model::create([
                    "name"=>$data[$i]["Device_Name"],
                    "description"=>"",
                    "gadget_id"=>$gadget->id,
                ]);
            }


            // Device
            $device = null;
            $_device = Device::findBy("device_id",$data[$i]["Device_ID"]);
            if($_device){
                $device = $_device;
            }else{
                $device = Device::create([
                    "name"=>$data[$i]["Device_Name"],
                    "device_id"=>$data[$i]["Device_ID"],
                    "description"=>"",
                    "model_id"=>$model->id,
                    "size_id"=>$size->id,
                    "color_id"=>$color->id,
                    "carrier_id"=>$carrier->id,
                    "price"=>0,
                ]);
            }

            // Condition
            $c_id = array();
            for($j=0;$j<count($data[$i]["Condition"]);$j++){
                $cName = $data[$i]["Condition"][$j]["Condition_Name"];
                $condition = null;
                $_condition = Condition::findBy("name",$cName);
                if($_condition){
                    $condition = $_condition;
                }else{
                    $condition = Condition::create([
                        "name"=>$cName,
                        "price"=>$data[$i]["Condition"][$j]["Condition_Price"],
                        "link"=>$data[$i]["Condition"][$j]["Deep_Link"]
                    ]);
                }
                $c_id[] = $condition->id;
            }
            $device->conditions()->sync($c_id);


        }
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ask for db migration refresh, default is no
    	if ($this->command->confirm('Do you wish to refresh migration before seeding, it will clear all old data ?')) {
            // Call the php artisan migrate:refresh
    		$this->command->call('migrate:refresh');
    		$this->command->warn("Data cleared, starting from blank database.");
    	}

        // Seed the default permissions
    	$permissions = Permission::defaultPermissions();

    	foreach ($permissions as $perms) {
    		Permission::firstOrCreate(['name' => $perms]);
    	}

    	$this->command->info('Default Permissions added.');

        // Confirm roles needed
    	if ($this->command->confirm('Create Roles for user, default is admin and user? [y|N]', true)) {

            // Ask for roles from input
    		$input_roles = $this->command->ask('Enter roles in comma separate format.', 'Admin,User');

            // Explode roles
    		$roles_array = explode(',', $input_roles);

            // add roles
    		foreach($roles_array as $role) {
    			$role = Role::firstOrCreate(['name' => trim($role)]);

    			if( $role->name == 'Admin' ) {
                    // assign all permissions
    				$role->syncPermissions(Permission::all());
    				$this->command->info('Admin granted all the permissions');
    			} else {
                    // for others by default only read access
    				$role->syncPermissions(Permission::where('name', 'LIKE', 'view_%')->get());
    			}

                // create one user for each role
    			$this->createUser($role);
    		}

    		$this->command->info('Roles ' . $input_roles . ' added successfully');

    	} else {
    		Role::firstOrCreate(['name' => 'User']);
    		$this->command->info('Added only default user role.');
    	}
        $this->dummy();
    	$this->command->warn('All done :)');

        for($i=1;$i<=100;$i++){
            $user = factory(User::class)->create();
            $user->assignRole("User");
        }

    }


    private function createUser($role)
    {
    	$user = factory(User::class)->create();
    	$user->assignRole($role->name);

    	if( $role->name == 'Admin' ) {
    		$this->command->info('Here is your admin details to login:');
    		$this->command->warn($user->email);
    		$this->command->warn('Password is "secret"');
    	}
    }

}
