<?
require('ChatLogParser.class.php');
require('Filter.class.php');
if(!isset($_GET['log'])){
    $file = 'handel';
}else{
    $file = $_GET['log'];
}

set_time_limit(3600);
$log = 'files/'.$file.'.txt';
$parser = new ChatLogParser($log);?>
<div class="file">Chat Log Analyse f&uuml;r: <?=$log?></div>
<div class="lineStats">
    <div class="lines total"><span class="label">Zeilen eingelesen: </span><?=$parser->numLines?></div>
    <div class="lines filterd"><span class="label">Zeilen gefiltert: </span><?=$parser->numFilteredLines?></div>
    <div class="lines error"><span class="label">Zeilen fehlerhaft: </span><?=$parser->numErrorLines?></div>
    <div class="lines multiple"><span class="label">Zeilen doppelt: </span><?=$parser->numMultipleLines?></div>
    <div class="lines final"><span class="label">Zeilen Final: </span><?=$parser->numFinalLines?></div>
</div>
<div class="wordStats">
    <div class="words total"><span class="label">W&ouml;rter: </span><?=$parser->numWords?></div>
    <div class="words diff"><span class="label">verschiedene W&ouml;rter: </span><?=count($parser->words)?></div>
    <table>
    <tr>
        <td class="colTitle">Anzahl</td>
        <td class="colTitle">Anteil</td>
        <td class="colTitle">Wort/Gruppe</td>
    </tr>
    <?
    $filter = new Filter();
    $groupedWords = $filter->group($parser->words);
    foreach($groupedWords as $data){
        ?>
        <tr>
            <td class="mainCount"><?=$data['count']?></td>
            <td class="mainPercent"><?=round($data['count']/$parser->numWords*100,2)?>%</td>
            <?if($_GET['detail']){
                if(count($data['words']) > 1){
                $grpLabel = '<td></td></tr>';
                foreach($data['words'] as $word){
                    $grpLabel .= '<tr><td></td><td></td><td><span class="word">'.$word['word'].'</span> (<span class="count">'.$word['count'].'</span>|<span class="percent">'.(round($word['count']/$data['count']*100,2)).'%</span>)  ';
                }
                echo $grpLabel;
                ?>
            <?}else{?>
                <td><span class="word"><?=$data['words'][0]['word']?></span> (<span class="count"><?=$data['words'][0]['count']?></span>)</td></tr>
            <?}?>
        <?}else{?>
            <td><span class="word"><?=$data['words'][0]['word']?></span> <span class="count"><?=count($data['words']) > 1 ? '(GRUPPE)' : ''?></span></td></tr>
        <?}?>
    <?}?>
    </table>
</div>
<style type="text/css">
    *{
        font-family:verdana;
        font-size:13px;
    }
    .file{
        font-weight:bold;
        font-style:italic;
        padding:10px;
    }
    .colTitle{
        font-size:14px;
        font-weight:bold;   
    }
    .percent,
    .mainPercent{
        color:red;
        font-weight:bold;
        font-size:11px;
    }
    .mainPercent{
        font-size:14px;
        padding-left:10px;
        min-width:60px;
    }
    .count,
    .mainCount{
        color:blue;
        font-weight:bold;
        font-size:11px;
    }
    .mainCount{
        font-size:14px;
        padding-right:10px;
        text-align:right;
    }
    .word{
        font-weight:bold;
        color:#222222;
    }
</style>
