<?php

namespace HIHO\Auth;

use Illuminate\Auth\UserProviderInterface,
    Illuminate\Auth\GenericUser;

class MyUserProvider
    implements UserProviderInterface
{

    /**
     * The hasher implementation.
     *
     * @var \Illuminate\Hashing\HasherInterface
     */
    protected $hasher;

    /**
     * The Eloquent user model.
     *
     * @var string
     */
    protected $model;

    /**
     * Create a new database user provider.
     *
     * @param  \Illuminate\Hashing\HasherInterface  $hasher
     * @param  string  $model
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $identifier
     * @return \Illuminate\Auth\UserInterface|null
     */
    public function retrieveById($identifier)
    {
        return $this->createModel()->newQuery()->find($identifier);
    }

    public function isDeferred()
    {
        return false;
    }

    /**
     * Retrieve a user by by their unique identifier and "remember me" token.
     *
     * @param  mixed  $identifier
     * @param  string  $token
     * @return \Illuminate\Auth\UserInterface|null
     */
    public function retrieveByToken($identifier, $token)
    {
        $model = $this->createModel();

        return $model->newQuery()
                        ->where($model->getKeyName(), $identifier)
                        ->where($model->getRememberTokenName(), $token)
                        ->first();
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Auth\UserInterface  $user
     * @param  string  $token
     * @return void
     */
    public function updateRememberToken(\Illuminate\Auth\UserInterface $user, $token)
    {
        $user->setAttribute($user->getRememberTokenName(), $token);

        $user->save();
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Auth\UserInterface|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        // First we will add each credential element to the query as a where clause.
        // Then we can execute the query and, if we found a user, return it in a
        // Eloquent User "model" that will be utilized by the Guard instances.
        if(\Illuminate\Support\Facades\Session::has("is_admin"))
        {
            $user = \Administrator::where('Account', '=', $credentials['username'])->first();
        }
        else
        {
            $user = \User::where('StuID', '=', $credentials['username'])->first();
        }

        return $user;
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Auth\UserInterface  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(\Illuminate\Auth\UserInterface $user, array $credentials)
    {
        $pop3 = new \POP3("cc.ncu.edu.tw");

        if(($error = $pop3->Open()) == ""){
            //計中email登入
            if(($error = $pop3->Login($credentials['username'], $credentials['password'], 0)) == "")
            {
                return true;
            }
        }
        return false;
    }

    /**
     * Create a new instance of the model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function createModel()
    {
        // $class = '\\'.ltrim($this->model, '\\');
        if(\Illuminate\Support\Facades\Session::has('is_admin'))
            return new \Administrator;
        return new \User;
    }

}

// {
//     /**
//     * @var UserService
//     */
//     /**
//      * The hasher implementation.
//      *
//      * @var \Illuminate\Hashing\HasherInterface
//      */
//     protected $hasher;

//     /**
//      * The Eloquent user model.
//      *
//      * @var string
//      */
//     protected $model;

//     /**
//      * Create a new database user provider.
//      *
//      * @param  \Illuminate\Hashing\HasherInterface  $hasher
//      * @param  string  $model
//      * @return void
//      */
//     public function __construct(HasherInterface $hasher, $model)
//     {
//         $this->model = $model;
//         $this->hasher = $hasher;
//     }

//     /**
//      * Retrieve a user by their unique identifier.
//      *
//      * @param  mixed  $identifier
//      *
//      * @return \Illuminate\Auth\UserInterface|null
//      */
//     public function retrieveByID($identifier)
//     {
//         if(Illuminate\Support\Facades\Session::has("is_admin"))
//         {
//             $user = Administrator::where('Account', '=', $identifier);
//         }
//         else
//         {
//             $user = User::where('StuID', '=', $identifier);
//         }

//         if (!$user instanceof User && !$user instanceof Administrator) {
//             return false;
//         }

//         return new GenericUser([
//             'id'       => $user->getUserIdentifier(),
//             'username' => $user->getUserName()
//         ]);
//     }

//     /**
//      * Retrieve a user by the given credentials.
//      *
//      * @param  array  $credentials
//      *
//      * @return \Illuminate\Auth\UserInterface|null
//      */
//     public function retrieveByCredentials(array $credentials)
//     {
//         if(Illuminate\Support\Facades\Session::has("is_admin"))
//         {
//             $user = Administrator::where('Account', '=', $credentials['username']);
//         }
//         else
//         {
//             $user = User::where('StuID', '=', $credentials['username']);
//         }

//         if (!$user instanceof User && !$user instanceof Administrator) {
//             return false;
//         }

//         return new GenericUser([
//             'id'       => $user->getUserIdentifier(),
//             'username' => $user->getUserName()
//         ]);
//     }

//     /**
//      * Retrieve a user by by their unique identifier and "remember me" token.
//      *
//      * @param  mixed  $identifier
//      * @param  string  $token
//      * @return \Illuminate\Auth\UserInterface|null
//      */
//     public function retrieveByToken($identifier, $token)
//     {
//         $model = $this->createModel();

//         return $model->newQuery()
//                         ->where($model->getKeyName(), $identifier)
//                         ->where($model->getRememberTokenName(), $token)
//                         ->first();
//     }

//     /**
//      * Update the "remember me" token for the given user in storage.
//      *
//      * @param  \Illuminate\Auth\UserInterface  $user
//      * @param  string  $token
//      * @return void
//      */
//     public function updateRememberToken(\Illuminate\Auth\UserInterface $user, $token)
//     {
//         $user->setAttribute($user->getRememberTokenName(), $token);

//         $user->save();
//     }

//     /**
//      * Validate a user against the given credentials.
//      *
//      * @param \Illuminate\Auth\UserInterface $user
//      * @param  array  $credentials
//      *
//      * @return bool
//      */
//      public function validateCredentials(\Illuminate\Auth\UserInterface $user, array $credentials)
//      {
//         $pop3 = new POP3("cc.ncu.edu.tw");

//         if(($error = $pop3->Open()) == ""){
//             //計中email登入
//             if(($error = $pop3->Login($credentials['username'], $credentials['password'], 0)) == "")
//             {
//                 return true;
//             }
//         }
//         return false;
//      }
// }