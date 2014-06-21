<?php
    class AdministratorController extends BaseController {
    /**
     * Setup the layout used by the controller.
     *
     * @return void
     *//*
        public function index()
        {
            $users = User::all();

            return View::make('users.index', array('users' => $users));
        }

        public function create()
        {
            $data = array(
                'depatments' => Department::all()       
            );
            return View::make('users.create',array('data' => $data));
        }

        public function store()
        {
            $account = Input::get('account');
            $password = Input::get('password');
            $password_check = Input::get('password_check');
            $department = Input::get('department');
            $grade = Input::get('grade');
            $email = Input::get('email');
            $phone = Input::get('phone');

            $user = new User;
            $user->student_id = $account;
            $user->password = $password;
            $user->department_id = $department;
            $user->grade_id = $grade;
            $user->email = $email;
            $user->phone = $phone;


            $validator = Validator::make(
                array(
                    'account' => $account,
                    'password' => $password,
                    'password_check' => $password_check,
                    'department_id' => $department,
                    'grade' => $grade,
                    'email' => $email,
                    'phone' => $phone
                ),
                array(
                    'account' => 'required|max:10',
                    'password' => 'required|max:20|min:6',
                    'password_check' => 'required|max:20|min:6',
                    'department_id' => 'required',
                    'grade' => 'required',
                    'email' => 'required|max:30|email',
                    'phone' => 'required|max:10'
                )
            );

            if ($validator->fails())
            {
                // The given data did not pass validation
                return Redirect::route('user.create')->withErrors($validator);
            }

            if($user->save())
            {
                return Redirect::route('user.index');
            }
            else
            {
                return 'failed';
            }
        }

        public function show($id)
        {
            
        }

        public function edit($id)
        {
            
        }

        public function update($id)
        {
            
        }

        public function destroy($id)
        {
            
        }
        */
    }
?>