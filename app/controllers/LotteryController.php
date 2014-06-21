<?php
    class LotteryController extends BaseController {
    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */ 
        public function __construct() {
            $this->beforeFilter('csrf', array('on' => 'post'));
            $this->beforeFilter('manager', array('except' => array('index', 'show','joinlottery','showResult')));
        }
        
        public function index()
        {
            $lotteries = Lottery::time()->paginate(10);
            return View::make('lottery.index', array('lotteries' => $lotteries));
        }

        public function create()
        {
            return View::make('lottery.create');
        }

        public function store()
        {
            
            $lottery_name = Input::get('lottery_name');
            $start_time = Input::get('start_time');
            $end_time = Input::get('end_time');
            $point = Input::get('point');
            $announce_time = Input::get('announce_time');
            $details = Input::get('editor1');

            $awards = array();
            $awards_map = array();
            $awards['name'] = Input::get('award_name');
            $awards['num_of_people'] = Input::get('num_of_people');
            for($i = 1; $i <= count($awards['name']); $i++) {
                $awards_map[$awards['name'][$i]] = $awards['num_of_people'][$i];
            }

            $lottery = new Lottery;
            $lottery->lottery_name = $lottery_name;
            $lottery->start_time = $start_time;
            $lottery->end_time = $end_time;
            $lottery->consume_point = $point;
            $lottery->announce_time = $announce_time;
            $lottery->details = $details;

            $validator=Validator::make(
                array(
                    'lottery_name'=>$lottery_name,
                    'point'=>$point,
                    'start_time'=>$start_time,
                    'end_time'=>$end_time,
                    'announce_time'=>$announce_time
                ),
                array(
                    'lottery_name'=>'required',
                    'point'=>'required',
                    'start_time'=>'required',
                    'end_time'=>'required',
                    'announce_time'=>'required'
                )
            );

            if ($validator->fails())
            {
                // The given data did not pass validation
                return Redirect::route('lottery.edit',$id)->withErrors($validator);
            }
            
            if($lottery->save())
            {
                foreach ($awards_map as $name => $num) {
                if($name == '')
                    break;
                $award = new Award();
                $award->award_name = $name;
                $award->num_of_people = $num;
                $award->lottery_id = $lottery->id;
                $award->save();
                }
                return Redirect::route('lottery.index');
            }
            else
            {
                return 'failed';
            }
        }

        public function show($id)
        {
            $data = array(
                'lottery' => Lottery::find($id)
            );
            return View::make('lottery.show',array( 'data' => $data ));
        }

        public function edit($id)
        {
            $data = array(
                'lottery' => Lottery::find($id)
            );
            return View::make('lottery.edit',array( 'data' => $data ));
        }

        public function update($id)
        {
            $lottery_name = Input::get('lottery_name');
            $start_time = Input::get('start_time');
            $end_time = Input::get('end_time');
            $point = Input::get('point');
            $announce_time = Input::get('announce_time');
            $details = Input::get('editor1');

            $awards = array();
            $awards_map = array();
            $awards['name'] = Input::get('award_name');
            $awards['num_of_people'] = Input::get('num_of_people');
            for($i = 1; $i <= count($awards['name']); $i++) {
                $awards_map[$awards['name'][$i]] = $awards['num_of_people'][$i];
            }

            $lottery = Lottery::find($id);
            $lottery->lottery_name = $lottery_name;
            $lottery->start_time = $start_time;
            $lottery->end_time = $end_time;
            $lottery->consume_point = $point;
            $lottery->announce_time = $announce_time;
            $lottery->details = $details;

            $validator=Validator::make(
                array(
                    'lottery_name'=>$lottery_name,
                    'point'=>$point,
                    'start_time'=>$start_time,
                    'end_time'=>$end_time,
                    'announce_time'=>$announce_time
                ),
                array(
                    'lottery_name'=>'required',
                    'point'=>'required',
                    'start_time'=>'required',
                    'end_time'=>'required',
                    'announce_time'=>'required'
                )
            );

            if ($validator->fails())
            {
                // The given data did not pass validation
                return Redirect::route('lottery.edit',$id)->withErrors($validator);
            }

            if($lottery->save())
            {
                foreach ($awards_map as $name => $num) {
                if($name == '')
                    break;
                $award = new Award();
                $award->award_name = $name;
                $award->num_of_people = $num;
                $award->lottery_id = $lottery->id;
                $award->save();
                }
                return Redirect::route('lottery.index');
            }
            else
            {
                return 'failed';
            }
        }

        public function destroy($id)
        {
            $lottery = Lottery::find($id);
            $lottery->delete();

            return Redirect::route('lottery.index');
        }

        public function joinlottery($id)
        {
            //報名參加抽獎後扣除點數，並記錄一筆資料
            $lottery = Lottery::find($id);
            Auth::user()->rule->point = Auth::user()->rule->point - $lottery->consume_point;
            if(Auth::user()->rule->point>=0){
                Auth::user()->rule->save();
                $lottery->lattendants()->attach(Auth::user()->OID);
                return Redirect::route('lottery.index');
            }
            else{
                echo "<script type='text/javascript'>alert('點數不足');window.location.href='../lottery';</script>";
                //return Redirect::route('lottery.index');
            }        
        }

         public function dodolottery($id)
        {
            $lottery = Lottery::find($id);
            $lottery->doLottery();
            return Redirect::route('showResult', $id);
        }

        public function showResult($id)
        {
            $lottery = Lottery::find($id);
            $result = $lottery->getResult();
            $awards = $lottery->awards;
            $data = array(
                'awards' => $awards,
                'result' => $result
            );
            return View::make('lottery/show_result',array( 'data' => $data ));
        }


    }
?>