<?php

namespace App\Http\Controllers;

use App\Comment;
use App\CommentDrug;
use App\Drug;
use App\DrugPharmacy;
use App\DrugPharmacyUser;
use App\NestedComment;
use App\Pharmacy;
use App\Vote;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class DrugsController extends Controller
{
    //inicijalizacija za koj se moze da gi pristapuva stranicte!!!
    public function __construct(){
        $this->middleware('auth', ['only' => ['create', 'edit', 'submitDislike', 'submitLike', 'postComment', 'postNestedComment']]);
    }

    public function index(){

        $drugs = DrugPharmacyUser::all();

        foreach($drugs as $drug){
            $votes = Vote::where('drug_pharmacy_id', '=', $drug->id)->get();

            $brLikes = 0;
            $brDislikes = 0;
            foreach($votes as $vote){
                if($vote->result == 1){
                    $brLikes++;
                }
                if($vote->result == -1){
                    $brDislikes++;
                }

                if(Auth::check() && $vote->voter_id == Auth::user()->id && $vote->result == 1){
                    $drug->userVoted = 1;
                }
                if(Auth::check() && $vote->voter_id == Auth::user()->id && $vote->result == -1){
                    $drug->userVoted = -1;
                }
            }
            $drug->numOfLikes = $brLikes;
            $drug->numOfDislikes = $brDislikes;
            //dd($drug->numOfLikes);
        }

        //dd($drugs);

        $disabeldB = "disabled";
        if(Auth::check()){
            $disabeldB = "";
        }

        //dd($user);

        return view('drug.index')->with([
            'drugs' => $drugs,
            'disable' => $disabeldB,
        ]);
    }

    public function create(){

        $drug = new Drug();
        
        $drugs = Drug::lists('name', 'id');
        
        //dd($drugs);
        
        //$drugs = DrugPharmacy::where('pharmacy_id', '=', Auth::user()->phar_id)->get();
        
//         $myDrugs = array();
//         foreach($drugs as $d){
//         	//$myDrugs[$d->drug->id] = $d->drug->name; 
//         }
        
        //dd($myDrugs);
        
        return view('drug.create')->with([
            'drug' => $drug,
        	'drugs' => $drugs,
        ]);
    }

    public function store(Requests\CreateDrugRequest $request){
        //dd($request->input('delivery_price'));

    	$drug = new Drug();
    	if(!is_numeric($request->input('name'))){
    		//dd("New");
    		$drug = new Drug();
    		$drug->name = $request->input('name');
    		$drug->img_url = $request->input('img_url');
    		$drug->desc = $request->input('desc');
    		
    		//dd($drug);
    		
    		$drug->save();
    	}
    	else{
    		$drug = Drug::where('id', '=', $request->input('name'))->get()->first();
    	}
    	
    	$drugPharmacyPrice = DrugPharmacy::where('drug_id', '=', $drug->id)
    				->where('pharmacy_id', '=', Auth::user()->phar_id)
    				->get()
    				->first();
    	
    	if(is_null($drugPharmacyPrice)){
    		//ke treba tuka da ja zemam odbranata Apteka pri registracijata!!!
    		//napraveno!!!!!!!
    		$pharmacy = Pharmacy::where('id', '=', Auth::user()->phar_id)->get()->first();
    	
    		$pharmacy->drugs()->attach($drug, array('drug_price' => $request->input('drug_price')));
    	}
    	

        //ke treba tuka da gi zimam i spored id-to na odbranata Apteka!!!
        //naprveno!!!!!!!
        $drugPharmacy = DrugPharmacy::where('drug_id', '=', $drug->id)
        				->where('pharmacy_id', '=', Auth::user()->phar_id)
        				->get()
        				->first();

        //dd($drugPharmacy);

        Auth::user()->selInto()->attach($drugPharmacy, array('delivery_price' => $request->input('delivery_price')));

        return redirect('/drugs');
    }

    public function show($id){
		$drugPharUser = DrugPharmacyUser::where('id', '=', $id)->get()->first();

        $comments = CommentDrug::where('drug_pharmacy_id', '=', $id)->get();

        $imaKom = -1;
        
        //dd($comments);
        
        if(!is_null($comments->first())){
        	$imaKom = $comments[sizeof($comments) - 1]->comment_id;
        }
        
        $nestedComments = NestedComment::all(); //site komentari za toj dfu

        //dd($nestedComments->last()->desc);

        //$votes = Vote::where('drug_pharmacy_id', '=', $id)->get();
        $votes = Vote::where('drug_pharmacy_id', '=', $id)->get();

        //dd($votes[0]);

        $brLikes = 0;
        $brDislikes = 0;
        foreach($votes as $vote){
            if($vote->result == 1){
                $brLikes++;
            }
            else if($vote->result == -1){
                $brDislikes++;
            }
        }
        //dd($brLikes);
        //dd($brDislikes);

        $drugPharUser->drug()->numOfLikes = $brLikes;
        $drugPharUser->drug()->numOfDislikes = $brDislikes;

        //dd($drugPharUser->drug()->numOfLikes = $brLikes);
        //dd($drugPharUser->drug()->numOfDislikes = $brDislikes);

        //dd($drugPharUser);

        $disabeldB = "disabled";
        if(Auth::check()){
            $disabeldB = "";
        }
        
        //dd($imaKom);

        return view('drug.show')->with([
            'drugPharUser' => $drugPharUser,
            'commentsList' => $comments,
            'numOfLikes' => $brLikes,
            'numOfDislikes' => $brDislikes,
            'disabled' => $disabeldB,
            'nestedComment' => $nestedComments,
        	'imaKom' => $imaKom,
        ]);
    }

    public function submitLike($drugs){
    	//dd($drugs);
    
    	$drugPharmacy = DrugPharmacy::where('drug_id', '=', $drugs)->get()->first();
    
    	$drugPharmacyUser = DrugPharmacyUser::where('id', '=', $drugs)->get()->first();
    
    	$votes = Vote::all();
    
    	$flag = true;
    	foreach($votes as $vote){
    		if($vote->voter_id == Auth::user()->id && $vote->delivery_id == $drugPharmacyUser->user->id
    				&& $vote->drug_pharmacy_id == $drugPharmacyUser->id){
    			$flag = false;
    			break;
    		}
    	}
    
    	if($flag) {
    		Vote::create([
    		'result' => 1,
    		'voter_id' => Auth::user()->id,
    		'delivery_id' => $drugPharmacyUser->user->id,
    		'drug_pharmacy_id' => $drugPharmacyUser->id,
    		]);
    
    		$myArray = array();
    		$myArray['delivery_id'] = $drugPharmacyUser->user->id;
    		$myArray['drug_pharmacy_id'] = $drugPharmacyUser->id;
    
    		return $myArray;
    	}
    	//return $drugs;
    
    	return "myNotOK";
    
    	//return redirect('drugs');
    
    	//dd($drugPharmacy);
    }

    public function submitDislike($drugs){
        $drugPharmacy = DrugPharmacy::where('drug_id', '=', $drugs)->get()->first();

        $drugPharmacyUser = DrugPharmacyUser::where('id', '=', $drugs)->get()->first();

        $votes = Vote::all();

        $flag = true;
        foreach($votes as $vote){
            if($vote->voter_id == Auth::user()->id && $vote->delivery_id == $drugPharmacyUser->user->id
                && $vote->drug_pharmacy_id == $drugPharmacyUser->id){
                $flag = false;
                break;
            }
        }

        if($flag) {
            Vote::create([
                'result' => -1,
                'voter_id' => Auth::user()->id,
                'delivery_id' => $drugPharmacyUser->user->id,
                'drug_pharmacy_id' => $drugPharmacyUser->id,
            ]);
            
            $myArray = array();
            $myArray['delivery_id'] = $drugPharmacyUser->user->id;
            $myArray['drug_pharmacy_id'] = $drugPharmacyUser->id;
            
            return $myArray;
        }

        return "myNotOK";
        
        //return redirect('drugs');

        //dd($drugPharmacy);
    }

    public function postComment(Requests\CommentRequest $request){
        $comment = $request->input('comment_text');
        $drugPharId = $request->input('drug_phar_id');

        //dd($comment);
        //dd($drugPharId);

        $commentSaved = Comment::create([
            'desc' => $comment,
            'user_id' => Auth::user()->id,
        ]);

        CommentDrug::create([
            'drug_pharmacy_id' => $drugPharId,
            'comment_id' => $commentSaved->id,
        ]);
        
        $myReturn = array();
        
        $myReturn['komentar'] = $comment;
        $myReturn['imeP'] = Auth::user()->name;
        $myReturn['prezimeP'] = Auth::user()->lastname;
        $myReturn['timeCom'] = $commentSaved->created_at; 
        
        return $myReturn;
        
        //$myPath = explode("/comment", $request->path());
        
        //dd($myPath);
        
        //return redirect($myPath[0]);
    }

    public function drugPrice($id){
        $myReturn = array();

        if(is_numeric($id)){
            $drugPharmacy = DrugPharmacy::where('drug_id', '=', $id)
                ->where('pharmacy_id', '=', Auth::user()->phar_id)
                ->get()
                ->first();

            //dd($drugPharmacy);

            if(!is_null($drugPharmacy)){
                $myReturn['cena'] = $drugPharmacy->drug_price;
                $myReturn['img_url'] = $drugPharmacy->drug->img_url;
                $myReturn['opis'] = $drugPharmacy->drug->desc;
            }
            else{
                $drug = Drug::where('id', '=', $id)->get()->first();

                $myReturn['cena'] = "";
                $myReturn['img_url'] = $drug->img_url;
                $myReturn['opis'] = $drug->desc;
            }

            //dd($myReturn);

            return $myReturn;
        }

        $myReturn['cena'] = "";
        $myReturn['img_url'] = "";
        $myReturn['opis'] = "";
        return $myReturn;
    }

    //tuka
    public function listAllDrugsFromUser(){
        //dd(Auth::user()->id);

        //if($user==Auth::user()->id){
        $newarray=[];
        $drugPharUser = DrugPharmacyUser::where('user_id', '=', Auth::user()->id)->get(); //niza od site so isto user_id
        //dd($drugPharUser->first());

        $prices=[];
        $names=[];
        $description=[];
        $urls=[];
        $drug_id=[];
        $drugPharId = [];
        foreach($drugPharUser as $dsf){
            array_push($prices, $dsf->drugPharmacy->drug_price);
            array_push($names, $dsf->drugPharmacy->drug->name);
            array_push($description, $dsf->drugPharmacy->drug->desc);
            array_push($urls,$dsf->drugPharmacy->drug->img_url);
            array_push($drug_id,$dsf->drugPharmacy->drug->id);
            array_push($drugPharId, $dsf->id);
        }
        // dd($drug_id);
        $tmp=[];
        $drugs=[];
        for($i=0; $i<count($prices); $i++){
            array_push($tmp, $names[$i]);
            array_push($tmp, $description[$i]);
            array_push($tmp, $prices[$i]);
            //array_push($tmp, $urls[$i]);
            //array_push($tmp, $drug_id[$i]);

            array_push($tmp, $drugPharId[$i]);

            array_push($drugs, $tmp);



            $tmp=[];
        }
        //dd($drugs);
        return view('drug.alldrugs')->with([
            'drugs'=>$drugs,
            'unauthorized' => 0,
        ]);
        // }
    }

    //tuka!!!
    public function destroy($id)
    {
        //dd($id);

        //dd("TUKA");

        //$drug = Drug::find($id);

        $drug = DrugPharmacyUser::where('id', '=', $id);

        $drug->delete();

        return redirect('alldrugs');
    }

    public function edit($id)
    {
        //dd($id);

        $dfu = DrugPharmacyUser::where('id', '=', $id)->get()->first();
        //dd($dfu->id);
        $drugPharmacy=DrugPharmacy::where('id', '=', $dfu->drug_pharmacy_id)->get()->first();

        $drug=Drug::where('id', '=', $drugPharmacy->drug_id)->get()->first();

        //dd($dfu->user_id);

        if($dfu->user_id != Auth::user()->id){
            return redirect('alldrugs');
        }

        //dd($drug->name);
        // dd($drugPharmacy->drug_price);
        return view('drug.edit')->with([
            'drugName' => $drug->name,
            'drugPrice' => $drugPharmacy->drug_price,
            'drugDesc' => $drug->desc,
            'drugDeliveryPrice' => $dfu->delivery_price,
            'drug' => $drug,
            'imgUrl' =>$drug->img_url,
            'dfu' => $dfu->id,

        ]);
    }

    public function update(Requests\CreateDrugRequest $request)
    {

        //dd($request->input('dfu'));

        $dfu = DrugPharmacyUser::where('id', '=', $request->input('dfu'))->get()->first();
        //dd($dfu->id);
        //$drugPharmacy=DrugPharmacy::where('id', '=', $dfu->id)->get()->first();

        //$drug=Drug::where('id', '=', $drugPharmacy->drug_id)->get()->first();

        //$input = array_except(Input::all(), '_method');
        //dd($input);
        //dd($dfu);
        $dfu->delivery_price=$request->input('delivery_price');
        //dd($dfu);

        $dfu->save();

        return redirect('drugs');
    }

    public function postNestedComment(Requests\SubCommentRequest $request){

        $nestedComment = $request->input('com_text');
        $commentId = $request->input('com_id');

        //dd($nestedComment);

        $commentSaved = NestedComment::create([
            'desc' => $nestedComment,
            'user_id' => Auth::user()->id,
            'comment_id' => $commentId,
        ]);

        //dali prethodno create socuvue u baza
        //$commentSaved->save();
        $myUrl = '/drugs/';
        $myUrl .= $request->input('drug_id');

        //dd($commentId);

        return redirect($myUrl);
    }

    //pri klik na kopce pokraj sekoj komentar ke gi pokazue vgnezdenite komentari
    public function getNestedCommentsOfAGivenComment($commentId){
        $nestedComments=NestedComment::where('comment_id', '=', $commentId)->all();
    }
    
    public function getLatestComments($drugs, $latestCom){
    	
    	//dd($drugs);
    	$comment = Comment::where('id', '=', $latestCom)->get()->first();
    	
    	//dd($comment->getDate());
    	
    	$comments = CommentDrug::where('drug_pharmacy_id', '=', $drugs)->get();
    	
    	$myReturn = array();
    	foreach ($comments as $c){
    		$momC = Comment::where('id', '=', $c->comment->id)->get()->first();
    		
    		if($momC->getDate() > $comment->getDate()){
    			//$pom = array();
    			//$pom[] = $momC;
    			//$pom[] = $momC->user;
    			
    			//$myReturn[] = $pom;
    			
    			$myReturn[] = $momC;
    			$myReturn[] = $momC->user;
    		}
    	}
    	
    	return $myReturn;
    }
}
