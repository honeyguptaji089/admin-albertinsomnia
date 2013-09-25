<?php

class ReportingController extends Controller
{
	public $layout='//layouts/super_admin',$total_school,$total_payment,$total_player=0,$total_teacher,$total_competition,$total_tests, $schoolGrades="",$Report="",
	$TeacherNames=array(), $avgScoresData=array(), $chartScript, $chartInfo, $canvasWidth;
	
	public function actionAdmin()
	{
		$this->total_school=School::model()->count();
		$this->total_payment=Player::model()->count(array(
			'condition'=>'payment_status = :payment_status',
			'params'=>array(
				':payment_status'=>1,
			),
		));
		$this->render('admin');
	}

	public function actionSchool()
	{
		$this->layout='//layouts/school_admin';
		
		$user_id_fk=intVal(Yii::app()->user->user_id);
		$SchoolData=School::model()->find(array('select'=>'id',
													'condition'=>'user_id_fk=:user_id_fk',
													'params'=>array(':user_id_fk'=>$user_id_fk)));
		$this->schoolGrades.="<option value='Select Grade'>Select Grade</option>";
		foreach($SchoolData->schoolGrades as $grade){
			$grade_name=SchoolGrades::model()->find(array('select'=>'grade_name',
													'condition'=>'id=:id',
													'params'=>array(':id'=>$grade->id)))->grade_name;
			$this->schoolGrades.="<option value='".$grade->id."'>".$grade_name."</option>";
		}
		
		
		if(isset($_POST['Reporting'])){
			$fromDate=$_POST['txtFromDate'];
			$toDate=$_POST['txtToDate'];
			$grade=$_POST['Reporting']['slSchoolGrade'];
			$dateArray=$this->getRange($fromDate,$toDate);
			$Reporting=array();
			
			$TeacherGradescriteria = new CDbCriteria();
			$TeacherGradescriteria->select = "DISTINCT t.teacher_id_fk";
			$TeacherGradescriteria->addCondition('t.grade_id_fk = '.$grade);
			$TeachersData = TeacherGrades::model()->findAll($TeacherGradescriteria);
			
			$this->TeacherNames=array("");
				
			foreach($TeachersData as $t){
				array_push($this->TeacherNames,Teacher::model()->find('id =:id',array(':id'=>$t->teacher_id_fk))->teacher_name);
			}	
			
			$Reporting[0] = $this->TeacherNames;
			
			foreach($dateArray as $date){
				$from_date="'".$date[0]."'";
				$to_date="'".$date[1]."'";
				
				$this->avgScoresData=array($date[2]);
				
				foreach($TeachersData as $t){
					
					$teacher=Teacher::model()->find('id =:id',array(':id'=>$t->teacher_id_fk));
					
					$AverageScore=array();
					$totalScore=0;
					$totalScoreCount=0;
					
					$testcriteria = new CDbCriteria();
					$testcriteria->select = "DISTINCT t.id";
					$testcriteria->addCondition('date >= '.$from_date);
					$testcriteria->addCondition('date <= '.$to_date);
					$testcriteria->addCondition('teacher_id_fk = '.$teacher->id);
					$tests = Test::model()->findAll($testcriteria);
					$testcount = Test::model()->count($testcriteria);
					
					if($testcount>0){
						foreach($tests as $t){
							$sorecriteria = new CDbCriteria();
							$sorecriteria->select = "t.score";
							$sorecriteria->addCondition('test_id_fk = '.$t->id);
							$ScoreData = TestScore::model()->findAll($sorecriteria);
							foreach($ScoreData as $s)
							{
								$totalScore+=$s->score;
								$totalScoreCount++;
							}
					
						if($totalScoreCount==0)
							array_push($this->avgScoresData, 0);
						else
							array_push($this->avgScoresData, intVal($totalScore/$totalScoreCount));
						}
					}
					else{
						array_push($this->avgScoresData, 0);
					}
				}
				array_push($Reporting,$this->avgScoresData);
				
			}
			$Reporting[0]=$this->TeacherNames;
			
			$columnWidth=count($this->TeacherNames)*150;
			
			$this->Report="";
			
							$this->chartInfo.="<h2>Test Report</h2><div>";
							for($m=1;$m<=count($this->TeacherNames)-1;$m++){
								$this->chartInfo.="<div class='teacherInfo'><span style='height:10px;width:10px;border:1px Solid;display: inline-block;'></span>
								<span>".$Reporting[0][$m]."</span></div>";
							}
							
							$this->chartInfo.="</div>";
								$this->Report.="<div style='width: 100%;height: 250px;overflow: scroll;'><table class='items' style='width:".$columnWidth."px'>";
										
			for($j=0;$j<=count($Reporting)-1;$j++){
				$row=$Reporting[$j];
				$columns=count($row);
				if($j==0){
					$this->Report.="<thead><tr>";
					for($k=0;$k<=count($row)-1;$k++){
						$this->Report.="<th>".$row[$k]."</th>";
					}
					$this->Report.="</tr></thead>";
				}
				else{
					$this->Report.="<tbody><tr>";
					for($k=0;$k<=count($row)-1;$k++){
						$this->Report.="<td>".$row[$k]."</td>";
					}
					$this->Report.="</tr></tbody>";
				}
			}	
			$this->Report.="</table></div>";
				
				
			$this->chartScript="<script type='text/javascript'>
								var colors=[];
								createColors(".(count($this->TeacherNames)-1).");	
								function createColors(length){
									for(var i=0;i<=length-1;i++){
										colors[i]='#'+(Math.random()*0xFFFFFF<<0).toString(16);
									}
								}
								var count=0;
								$('.teacherInfo span:nth-child(1)').each(function(index,value){
									$(value).css('background-color',colors[count]);
									count++;
								});
								var lineChartData = {
										labels : ['Start', ";
									for($l=0;$l<=count($Reporting)-1;$l++){
										if($l>0){
											$this->chartScript.="'".$Reporting[$l][0]."',";
										}
									}	
							
							$this->chartScript.="],
										datasets : [";
										$color_count=0;
										for($m=1;$m<=count($this->TeacherNames)-1;$m++){
										
							$this->chartScript.="{
													fillColor : '#FFF',
													strokeColor : colors[".$color_count."],
													pointColor : colors[".$color_count."],
													pointStrokeColor : '#FFF',
													data : [0,";
														for($n=1;$n<=count($Reporting)-1;$n++){
																$this->chartScript.=$Reporting[$n][$m].",";
																
														}	
													
									$this->chartScript.="]
												},";
											$color_count++;
										}
										$this->chartScript.="]
									};

							var myLine = new Chart(document.getElementById('canvas').getContext('2d')).Line(lineChartData);
							</script>";
							
			$this->canvasWidth=count($Reporting)*150;
			
		}
		$this->render('school');
		
		
	}
	public function getRange($startDate,$endDate) { 
		
		$startDate = strtotime($startDate); $endDate = strtotime($endDate);
		$Start = $startDate;
		$Result = Array();
		while ($Start <= $endDate)
		{    
			$Result[] = date('Y-m', $Start);
			$Start = strtotime( date('Y-m-d',$Start).' +1 month');
		}
		$length=count($Result);
		for($i=0;$i<=$length-1;$i++){
			if($i==0){
				$Result[$i]= array(date('Y-m-d',$startDate)." 00:00:00", $Result[$i]."-".date('t',strtotime($startDate))." 23:59:59", $Result[$i]);
			}
			else if($i==$length-1){
				$Result[$i]= array($Result[$i]."-1 00:00:00", date('Y-m-d',$endDate)." 23:59:59", $Result[$i]);
			}
			else{
				$Result[$i]= array($Result[$i]."-1 00:00:00", $Result[$i]."-".date('t',strtotime($Result[$i]."-1"))." 23:59:59", $Result[$i]);
			}
			
		}
		return $Result;
	}
	public function actionTeacher(){
		$this->layout='//layouts/teacher';
		$user_id_fk=intVal(Yii::app()->user->user_id);
		$teacherData=Teacher::model()->find(array('select'=>'id,school_id_fk','condition'=>'user_id_fk=:user_id_fk','params'=>array(':user_id_fk'=>$user_id_fk)));
		$this->schoolGrades.="<option value='Select Grade'>Select Grade</option>";
		foreach($teacherData->schoolIdFk->schoolGrades as $grade){
			$this->schoolGrades.="<option value='".$grade->id."'>".$grade->grade_name."</option>";
		}
		if(isset($_POST['Reporting'])){
			$grade_id=$_POST['Reporting']['slSchoolGrade'];
			$report_type=$_POST['Reporting']['slReportType'];
			$from_date="'".$_POST['txtFromDate']." 00:00:00'";
			$to_date="'".$_POST['txtToDate']." 00:00:00'";
			$SchoolClass=SchoolClass::model()->findAll('grade_id_fk=:grade_id_fk',array(':grade_id_fk'=>$grade_id));
			$test_group=array();
			$comp_group=array();
			foreach($SchoolClass as $class){
				$SchoolGroup=SchoolGroup::model()->findAll('class_id_fk=:class_id_fk',array(':class_id_fk'=>$class->id));
				foreach($SchoolGroup as $group){
					if($group->is_competition_group==0){
						array_push($test_group, $group->id);
					}
					else{
						array_push($comp_group, $group->id);
					}
				}
			}
			
			if($report_type=="Test Report"){
				$testcriteria = new CDbCriteria();
				$testcriteria->select = "DISTINCT t.id";
				$testcriteria->addCondition('date >= '.$from_date);
				$testcriteria->addCondition('date <= '.$to_date);
				$testcriteria->join='INNER JOIN test_groups ON test_groups.test_id_fk=t.id';
				$testcriteria->addInCondition("test_groups.group_id_fk", array_unique($test_group));
				$testcriteria->order = 't.date';
				$testcriteria->limit = 2;
				$tests = Test::model()->findAll($testcriteria);
				$totalTests=count($tests);
				if($totalTests==2){
					$testResult=array();
					$i=1;
					$firstTestPlayer=array();
					$secondTestPlayer=array();
					$firstTestID=0;
					$secondTestID=0;
					foreach($tests as $t){
						$playercriteria = new CDbCriteria();
						$playercriteria->select = "DISTINCT t.player_id_fk";
						$playercriteria->addCondition('test_groups.test_id_fk = '.$t->id);
						$playercriteria->join='INNER JOIN test_groups ON test_groups.group_id_fk=t.group_id_fk';
						$playercriteria->order = 't.player_id_fk';
						$playerData = GroupPlayer::model()->findAll($playercriteria);
						$players=array();
						if($i==1){
							$firstTestID=$t->id;
							foreach($playerData as $p)
								array_push($firstTestPlayer,$p->player_id_fk);
												
						}
						else if($i==2){
							$secondTestID=$t->id;
							foreach($playerData as $p)
								array_push($secondTestPlayer,$p->player_id_fk);
								
						}
						$i++;
					}
					
					$firstTestPlayer = $secondTestPlayer = array_unique(array_merge($firstTestPlayer, $secondTestPlayer));

					$firstTestScores = $this->fillTestScore($firstTestPlayer, $firstTestID);
					usort($firstTestScores, array('ReportingController','scoreDescSort'));
					$firstTestScores=$this->addRankInfo($firstTestScores);
					usort($firstTestScores, array('ReportingController','playerSort'));
					
					$secondTestScores = $this->fillTestScore($secondTestPlayer, $secondTestID);
					usort($secondTestScores, array('ReportingController','scoreDescSort'));
					$secondTestScores=$this->addRankInfo($secondTestScores);
					usort($secondTestScores, array('ReportingController','playerSort'));
					
					$diffArray = $this->arrayDiff($firstTestScores, $secondTestScores);
					
					$rowCount=count($firstTestPlayer);
					$this->Report="<h2>Test Report</h2><b>Current Test: ".$this->getTestName($secondTestID)."</b> on <b>".$this->getTestDate($secondTestID)."</b><br/><br/>";
					$this->Report.="<b>Previous Test: ".$this->getTestName($firstTestID)."</b> on <b>".$this->getTestDate($firstTestID)."</b><br/>";
					$this->Report.="<br/><table class='items'>
							<thead>
								<tr>
									<th>Player Name</th>
									<th>Current Score</th>
									<th>Previous Score</th>
									<th>Change in Score</th>
									<th>Current Rank</th>
									<th>Previous Rank</th>
									<th>Change in Rank</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<table>";
						for($k=1;$k<=$rowCount;$k++)
							$this->Report.= "<tr><td>".$this->getPlayerName($firstTestScores[$k-1]['player_id'])."</td></tr>";
						$this->Report.="		</table>
									</td>
									<td>
										<table>";
						for($k=1;$k<=$rowCount;$k++)
							$this->Report.= "<tr><td>".$firstTestScores[$k-1]['score']."</td></tr>";
						$this->Report.= 			"</table>
									</td>
									<td>
										<table>";
						for($k=1;$k<=$rowCount;$k++)
							$this->Report.= "<tr><td>".$secondTestScores[$k-1]['score']."</td></tr>";
						$this->Report.= 			"</table>
									</td>
									<td>
										<table>";
						for($k=1;$k<=$rowCount;$k++)
							$this->Report.= "<tr><td>".$diffArray[$k-1]['score']."</td></tr>";
						$this->Report.= 			"</table>
									</td>
									<td>
										<table>";
						for($k=1;$k<=$rowCount;$k++)
							$this->Report.= "<tr><td>".$firstTestScores[$k-1]['rank']."</td></tr>";
						$this->Report.= 			"</table>
									</td>
									<td>
										<table>";
						for($k=1;$k<=$rowCount;$k++)
							$this->Report.= "<tr><td>".$secondTestScores[$k-1]['rank']."</td></tr>";
						$this->Report.= 			"</table>
									</td>
									<td>
										<table>";
						for($k=1;$k<=$rowCount;$k++)
							$this->Report.= "<tr><td>".$diffArray[$k-1]['rank']."</td></tr>";
						$this->Report.="</table>
									</td>
								</tr>
							</tbody>	
						</table>";
					
				}
				if($totalTests==1){
					$this->Report="<b>This Search Criteria found only one Test. Report for one Test is currently unavailable</b>";
				}
				if($totalTests==0){
					$this->Report="<b>This Search Criteria found no Test. Please choose different Criteria</b>";
				}
			}
			else if($report_type=="Competition Report"){
				$competitioncriteria = new CDbCriteria();
				$competitioncriteria->select = "DISTINCT t.id";
				$competitioncriteria->addCondition('date >= '.$from_date);
				$competitioncriteria->addCondition('date <= '.$to_date);
				$competitioncriteria->join='INNER JOIN competition_groups ON competition_groups.competition_id_fk=t.id';
				$competitioncriteria->addInCondition("competition_groups.group_id_fk", array_unique($comp_group));
				$competitioncriteria->order = 't.date';
				$competitioncriteria->limit = 2;
				$competitions = Competition::model()->findAll($competitioncriteria);
				$totalCompetition=count($competitions);
				if($totalCompetition==2){
					$i=1;
					$firstCompetitionPlayer=array();
					$secondCompetitionPlayer=array();
					$firstCompetitionID=0;
					$secondCompetitionID=0;
					foreach($competitions as $c){
						$playercriteria = new CDbCriteria();
						$playercriteria->select = "DISTINCT t.player_id_fk";
						$playercriteria->addCondition('competition_groups.competition_id_fk = '.$c->id);
						$playercriteria->join='INNER JOIN competition_groups ON competition_groups.group_id_fk=t.group_id_fk';
						$playercriteria->order = 't.player_id_fk';
						$playerData = GroupPlayer::model()->findAll($playercriteria);
						$players=array();
						if($i==1){
							$firstCompetitionID=$c->id;
							foreach($playerData as $p)
								array_push($firstCompetitionPlayer,$p->player_id_fk);
												
						}
						else if($i==2){
							$secondCompetitionID=$c->id;
							foreach($playerData as $p)
								array_push($secondCompetitionPlayer,$p->player_id_fk);
								
						}
						$i++;
					}
					
					$firstCompetitionPlayer = $secondCompetitionPlayer = array_unique(array_merge($firstCompetitionPlayer, $secondCompetitionPlayer));

					$firstCompetitionScores = $this->fillCompetitionScore($firstCompetitionPlayer, $firstCompetitionID);
					usort($firstCompetitionScores, array('ReportingController','scoreDescSort'));
					$firstCompetitionScores=$this->addRankInfo($firstCompetitionScores);
					usort($firstCompetitionScores, array('ReportingController','playerSort'));
					
					$secondCompetitionScores = $this->fillCompetitionScore($secondCompetitionPlayer, $secondCompetitionID);
					usort($secondCompetitionScores, array('ReportingController','scoreDescSort'));
					$secondCompetitionScores=$this->addRankInfo($secondCompetitionScores);
					usort($secondCompetitionScores, array('ReportingController','playerSort'));
					
					$diffArray = $this->arrayDiff($firstCompetitionScores, $secondCompetitionScores);
					
					$rowCount=count($firstCompetitionPlayer);
					
					$this->Report="<h2>Competition Report</h2><b>Current Competition: ".$this->getCompetitionName($secondCompetitionID)."</b> on <b>".$this->getCompetitionDate($secondCompetitionID)."</b><br/><br/>";
					$this->Report.="<b>Previous Competition: ".$this->getCompetitionName($firstCompetitionID)."</b> on <b>".$this->getCompetitionDate($firstCompetitionID)."</b><br/>";
					$this->Report.="<br/><table class='items'>
							<thead>
								<tr>
									<th>Player Name</th>
									<th>Current Score</th>
									<th>Previous Score</th>
									<th>Change in Score</th>
									<th>Current Rank</th>
									<th>Previous Rank</th>
									<th>Change in Rank</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<table>";
						for($k=1;$k<=$rowCount;$k++)
							$this->Report.= "<tr><td>".$this->getPlayerName($firstCompetitionScores[$k-1]['player_id'])."</td></tr>";
						$this->Report.="		</table>
									</td>
									<td>
										<table>";
						for($k=1;$k<=$rowCount;$k++)
							$this->Report.= "<tr><td>".$firstCompetitionScores[$k-1]['score']."</td></tr>";
						$this->Report.= 			"</table>
									</td>
									<td>
										<table>";
						for($k=1;$k<=$rowCount;$k++)
							$this->Report.= "<tr><td>".$secondCompetitionScores[$k-1]['score']."</td></tr>";
						$this->Report.= 			"</table>
									</td>
									<td>
										<table>";
						for($k=1;$k<=$rowCount;$k++)
							$this->Report.= "<tr><td>".$diffArray[$k-1]['score']."</td></tr>";
						$this->Report.= 			"</table>
									</td>
									<td>
										<table>";
						for($k=1;$k<=$rowCount;$k++)
							$this->Report.= "<tr><td>".$firstCompetitionScores[$k-1]['rank']."</td></tr>";
						$this->Report.= 			"</table>
									</td>
									<td>
										<table>";
						for($k=1;$k<=$rowCount;$k++)
							$this->Report.= "<tr><td>".$secondCompetitionScores[$k-1]['rank']."</td></tr>";
						$this->Report.= 			"</table>
									</td>
									<td>
										<table>";
						for($k=1;$k<=$rowCount;$k++)
							$this->Report.= "<tr><td>".$diffArray[$k-1]['rank']."</td></tr>";
						$this->Report.="</table>
									</td>
								</tr>
							</tbody>	
						</table>";
					
				}
				if($totalCompetition==1){
					$this->Report="<b>This Search Criteria found only one Competition. Report for one Competition is currently unavailable</b>";
				}
				if($totalCompetition==0){
					$this->Report="<b>This Search Criteria found no Competition. Please choose different Criteria</b>";
				}
				
			}
			
		}
		
		$this->render('teacher');
	}
	public function getPlayerName($id){
		return Player::model()->find('id=:id',array(':id'=>$id))->player_name;
	}
	public function getTestName($id){
		return Test::model()->find('id=:id',array(':id'=>$id))->test_name;
	}
	public function getTestDate($id){
		if(isset($_COOKIE['YIITZ'])){
			$test_date=Test::model()->find('id=:id',array(':id'=>$id))->date;
			$st_timezone = str_replace("*", "+", $_COOKIE['YIITZ']);
			$date=date('F j, Y, g:i A', strtotime($test_date . $st_timezone));
		}
		return $date;
	}
	public function getCompetitionName($id){
		return Competition::model()->find('id=:id',array(':id'=>$id))->competition_name;
	}
	public function getCompetitionDate($id){
		if(isset($_COOKIE['YIITZ'])){
			$competition_date=Competition::model()->find('id=:id',array(':id'=>$id))->date;
			$st_timezone = str_replace("*", "+", $_COOKIE['YIITZ']);
			$date=date('F j, Y, g:i A', strtotime($competition_date . $st_timezone));
		}
		return $date;
	}
	public function fillCompetitionScore($array, $comp_id){
		$scoreData=array();
		foreach($array as $p){
			$player=array();
			$player_score_exists = CompetitionScore::model()->countByAttributes(array(
				'competition_id_fk'=> $comp_id,
				'player_id_fk'=> $p,
			));
			if($player_score_exists>0){
				$criteria = new CDbCriteria();
				$criteria->select = "t.score";
				$criteria->addCondition('t.competition_id_fk = '.$comp_id);
				$criteria->addCondition('t.player_id_fk = '.$p);
				$Data = CompetitionScore::model()->findAll($criteria);
				foreach($Data as $ts){
					$player['score']=$ts->score;
					$player['player_id']=$p;
				}
			}
			else{
				$player['score']=0;
				$player['player_id']=$p;
			}
			array_push($scoreData,$player);
		}
		return $scoreData;
	}
	public function fillTestScore($array, $test_id){
		$scoreData=array();
		foreach($array as $p){
			$player=array();
			$player_score_exists = TestScore::model()->countByAttributes(array(
				'test_id_fk'=> $test_id,
				'player_id_fk'=> $p,
			));
			if($player_score_exists>0){
				$criteria = new CDbCriteria();
				$criteria->select = "t.score";
				$criteria->addCondition('t.test_id_fk = '.$test_id);
				$criteria->addCondition('t.player_id_fk = '.$p);
				$Data = TestScore::model()->findAll($criteria);
				foreach($Data as $ts){
					$player['score']=$ts->score;
					$player['player_id']=$p;
				}
			}
			else{
				$player['score']=0;
				$player['player_id']=$p;
			}
			array_push($scoreData,$player);
		}
		return $scoreData;
	}
	public function addRankInfo($array){
		$j=1;
		foreach($array as $key => &$value){
			$value['rank']=$j;
			$j++;
		}
		return $array;
	}
	public function scoreDescSort($item1,$item2)	{
		if ($item1['score'] == $item2['score']) return 0;
		return ($item1['score'] < $item2['score']) ? 1 : -1;
	}
	public function playerSort($item1,$item2)	{
		if ($item1['player_id'] == $item2['player_id']) return 0;
		return ($item1['player_id'] > $item2['player_id']) ? 1 : -1;
	}
	public function arrayDiff($arr1, $arr2) { 
		$array = array(); 
		
		foreach($arr2 as $key=>$value){
			$small=array();
			$small['player_id']=$value['player_id'];
			$small['score']= $arr1[$key]['score'] - $value['score'];
			$small['rank']=$arr1[$key]['rank'] - $value['rank'];
			array_push($array, $small);
		}
		return $array; 
	} 
}


/*

//
===============================
School Report Old Code
===============================

$user_id=intVal(Yii::app()->user->user_id);
	$school_id=School::model()->find('user_id_fk=:user_id_fk',array(':user_id_fk'=>$user_id))->id;
	$SchoolGradeData=SchoolGrades::model()->findAll('school_id_fk=:school_id_fk',array(':school_id_fk'=>$school_id));
	$SchoolGroups=array();$Competitions=array();$Tests=array();
	foreach($SchoolGradeData as $grade_data){
		$SchoolClassData=SchoolClass::model()->findAll('grade_id_fk=:grade_id_fk',array(':grade_id_fk'=>$grade_data->id));
		foreach($SchoolClassData as $class_data){
			$totalClassPlayer=Player::model()->count('player_class_id_fk=:player_class_id_fk',array(':player_class_id_fk'=>$class_data->id));
			$this->total_player+=$totalClassPlayer;
			$SchoolGroupsData=SchoolGroup::model()->findAll('class_id_fk=:class_id_fk',array(':class_id_fk'=>$class_data->id));
			foreach($SchoolGroupsData as $group_data){
				array_push($SchoolGroups,$group_data->id);
			}
		}
	}
	
	$this->total_teacher=Teacher::model()->count('school_id_fk=:school_id_fk',array(':school_id_fk'=>$school_id));
	
	$CompetitionGroupData=CompetitionGroups::model()->findAll();
	foreach($CompetitionGroupData as $comp_data){
		if(in_array($comp_data->group_id_fk, $SchoolGroups)){
			array_push($Competitions,$comp_data->competition_id_fk);
		}
	}
	$this->total_competition = count(array_unique($Competitions));
	
	$TestGroupData=TestGroups::model()->findAll();
	foreach($TestGroupData as $test_data){
		if(in_array($test_data->group_id_fk, $SchoolGroups)){
			array_push($Tests,$test_data->test_id_fk);
		}
	}
	$this->total_tests = count(array_unique($Tests));
	*/