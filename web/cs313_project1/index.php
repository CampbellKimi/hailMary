<?php

require("dbConnect.php");

$db = get_db();
$stat = $_GET['stat'];
// if($stat = "insert"){
//   $input = $_GET['input'];
  
//   $outcome = $_GET['outcome'];
//   switch($outcome){
//     case "win":
//       $statement = $db->prepare("INSERT INTO results (win, loss, input) VALUES (TRUE, FALSE, ".$input.")");
//       $statement->execute();
//     break;
//     case "loss":
//       $statement = $db->prepare("INSERT INTO results (win, loss, input) VALUES (FALSE, TRUE, ".$input.")");
//       $statement->execute();
//     break;
//     case "tie":
//       $statement = $db->prepare("INSERT INTO results (win, loss, input) VALUES (FALSE, FALSE, ".$input.")");
//       $statement->execute();
//     break;
//   }

// }
$game_id = array();
$win = array();
$loss = array();
$input = array();
$i = 0;
$result = array();

try
{

  $statement = $db->prepare('SELECT game_id, win, loss, input FROM reezys');
	$statement->execute();

  
	while ($row = $statement->fetch())
	{
        $game_id[$i] = $row['game_id'];
        $win[$i] = (($row['win']) ? TRUE : FALSE);
        $loss[$i] = (($row['loss']) ? TRUE : FALSE);
        $input[$i] = $row['input'];
        
        $result[$i] = array(
          "game_id" => $game_id[$i],
          "win" => $win[$i],
          "loss" => $loss[$i],
          "input" => $input[$i]
        );
        $i++;
	}
}
catch (PDOException $ex)
{
	echo "Error connecting to DB. Details: $ex";
	die();
}
$wins = 0;
$losses = 0;
$ties = 0;
foreach($result as $r){

  switch($stat){
    case "rock":
      if($r["input"] == "rock"){
        if($r["win"] == TRUE){
          $win++;
        }
        if($r["loss"] == TRUE){
          $losses++;
        }
        if($r["win"] == FALSE && $r["loss"] == FALSE){
          $ties++;
        }

      }
      if($r["input"] == "paper"){
        if($r["win"] == TRUE){
          $losses++;
        }
      }
      if($r["input"] == "scissors"){
        if($r["loss"] == TRUE){
          $wins++;
        }
      }
    break;
    
    case "paper":
      if($r["input"] == "paper"){
        if($r["win"] == TRUE){
          $wins++;
        }
        if($r["loss"] == TRUE){
          $losses++;
        }
        if($r["win"] == FALSE && $r["loss"] == FALSE){
            $ties++;
        }
      }
      if($r["input"] == "rock"){
        if($r["loss"] == TRUE){
          $wins++;
        }
      }
      if($r["input"] == "scissors"){
          if($r["win"] == TRUE){
            $losses++;
          }
      }
    break;
    
    case "scissors":
      if($r["input"] == "rock"){
        if($r["win"] == TRUE){
          $losses++;
        }
      }
      if($r["input"] == "paper"){
        if($r["loss"] == TRUE){
          $wins++;
        }
      }
      if($r["input"] == "scissors"){
        if($r["win"] == TRUE){
          $wins++;
        }
        if($r["loss"] == TRUE){
          $losses++;
        }
        if($r["win"] == FALSE && $r["loss"] == FALSE){
          $ties++;
        }        
      }
    break;
  }
}

$total_games = count($game_id);
$win_percentage = round((($wins/$total_games)*100))."%";
$loss_percentage = round((($losses/$total_games)*100))."%";
$tie_percentage = round((($ties/$total_games)*100))."%";

echo "<table>
      <tr>
        <th>Wins</th><th>Losses</th><th>Ties</th>
      </tr>
      <tr>
        <td>".$win_percentage."</td><td>".$loss_percentage."</td><td>".$tie_percentage."</td>
      </tr>
      </table>";
