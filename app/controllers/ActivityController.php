<?php
    class ActivityController extends BaseController {
    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
        public function __construct() {
            $this->beforeFilter('csrf', array('on' => 'post'));
            $this->beforeFilter('manager');
        }

        public function index()
        {
            $activities = Activity::desc()->paginate(10);

            return View::make('activity.index', array('activities' => $activities));
        }
/*
        public function show($id)
        {
            
        }
*/
        public function edit($OID)
        {
            $data = array(
                'activity' => Activity::find($OID)
            );
            return View::make('activity.edit',array( 'data' => $data ));
        }

        public function update($OID)
        {
            
            $point = Input::get('point');
            $atid_array = Input::get('atid');
            $activity = Activity::find($OID);
            $info = new ActivityInfo();
            $info->point = $point;
            $info->activity_id = $activity->OID;

            $validator = Validator::make(
                array(
                    'point' => $point
                ),
                array(
                    'point' => 'required'
                )
            );

            if($validator->fails())
            {
                // The given data did not pass validation
                return Redirect::route('activity.edit', $OID)->withErrors($validator);
            }

            foreach ($atid_array as $key => $value) {
                # code...
                $attendant = $activity->attendants->find($key);
                if(!isset($attendant->rule->user_id))
                {
                    $id = $attendant->OID;
                    $rule = new Rule;
                    $rule->user_id = $id;
                    $rule->point = $rule->point +(int)$point;
                    $rule->save();
                }
                else
                {
                    $attendant->rule->point = $attendant->rule->point +(int)$point;
                    $attendant->rule->save();
                }               
            }

            if($info->save())
            {
                return Redirect::route('activity.index');
            }
            else
            {
                return 'failed';
            }
        }
    }
?>