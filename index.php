<?
error_reporting(E_ALL);
require('ChatLogParser.class.php');
require('Filter.class.php');
if(!isset($_GET['log'])){
    $file = 'handel';
}else{
    $file = $_GET['log'];
}

if(!isset($_GET['druck'])){
	$print = false;
}else{
	$print = true;
}

set_time_limit(3600);
$log = 'files/'.$file.'.txt';
$parser = new ChatLogParser($log);
if(!$print){?>
<div class="file">Chat Log Analyse f&uuml;r: <?=$log?></div>
<div class="lineStats">
    <div class="lines total"><span class="label">Zeilen eingelesen: </span><?=$parser->numLines?></div>
    <div class="lines filterd"><span class="label">Zeilen gefiltert: </span><?=$parser->numFilteredLines?></div>
	<?foreach($parser->filteredLines as $filtered){
		echo $filtered;
	}?>
    <div class="lines error"><span class="label">Zeilen fehlerhaft: </span><?=$parser->numErrorLines?></div>
    <div class="lines multiple"><span class="label">Zeilen doppelt: </span><?=$parser->numMultipleLines?></div>
    <div class="lines final"><span class="label">Zeilen Final: </span><?=$parser->numFinalLines?></div>
</div>
<?}?>
<div class="wordStats">
	<?if(!$print){?>
    <div class="words total"><span class="label">W&ouml;rter: </span><?=$parser->numWords?></div>
    <div class="words diff"><span class="label">verschiedene W&ouml;rter: </span><?=count($parser->words)?></div>
	<?}?>
    <table>
	<?if(!$print){?>
    <tr>
        <td class="colTitle">Anzahl</td>
        <td class="colTitle">Anteil</td>
        <td class="colTitle">Wort/Gruppe</td>
        <td class="colTitle">Worteinordnung</td>
        <td class="colTitle">filtername</td>
        <td class="colTitle">kommt von...</td>
        <td class="colTitle">Anmerkung</td>
        <td class="colTitle">Sprache</td>
        <td class="colTitle">schon bearbeitet</td>
        <?if(isset($_GET['rawdata'])){?>
            <td class="colTitle">Zuweisung</td>
        <?}?>
    </tr>
	<?}else{?>
	<tr>
		<td class="colTitle">Anzahl</td>
		<td class="colTitle">Anteil</td>
		<td class="colTitle">Wort/Gruppe</td>
		<td class="colTitle">Worteinordnung</td>
		<!--<td class="colTitle">filtername</td>-->
		<td class="colTitle">kommt von...</td>
		<!--<td class="colTitle">Anmerkung</td>-->
		<!--<td class="colTitle">Sprache</td>-->
		<!--<td class="colTitle">schon bearbeitet</td>-->
	</tr>
	<?}
    $filter = new Filter(true);
    $groupedWords = $filter->group($parser->words);
    $countSkiped = 0;
    $countUnfinished = 0;
    $countLang = 0;
    $countUniseg = array(
        'count' => 0,
        'detail' => array('kopfwort' => 0,'endwort' => 0,'klammerwort' => 0, 'rumpfwort' => 0)
    );
    $countMultiseg = array(
        'count' => 0,
        'detail' => array('initialwort' => 0, 'silbenkurzwort' => 0, 'mischkurzwort' => 0)
    );
    if(isset($_GET['gruppe'])){
        $gruppe = $_GET['gruppe'];
    }
    $countLang = array('e' => 0, 'd' => 0);
    $countLangShort = array(
        'count' => 0,
        'd' => 0,
        'e' => 0,
        'detail' => array(
            'kopfwort' => array('e' => 0,'d' => 0, 'count' => 0),
            'endwort' => array('e' => 0,'d' => 0, 'count' => 0),
            'klammerwort' => array('e' => 0,'d' => 0, 'count' => 0),
            'rumpfwort' => array('e' => 0,'d' => 0, 'count' => 0),
            'initialwort' => array('e' => 0,'d' => 0, 'count' => 0),
            'silbenkurzwort' => array('e' => 0,'d' => 0, 'count' => 0),
            'mischkurzwort' => array('e' => 0,'d' => 0, 'count' => 0),
            'partielles kurzwort' => array('e' => 0,'d' => 0, 'count' => 0),
            'homophone abkürzung' => array('e' => 0,'d' => 0, 'count' => 0),
            'numeral' => array('e' => 0,'d' => 0, 'count' => 0)
        )
    );
    
    foreach($groupedWords as $data){
		if($_GET['rawdata']){
			foreach($data['words'] as $word){?>
				<?if($_GET['skipX'] && $word['options'][8] === 'x') continue;?>
				<tr>
					<td class="mainCount"><?=$word['count']?></td>
					<td><span class="word"><?=$word['word']?></span></td>
					<td class="mainPercent"><?=round($word['count']/$parser->numWords*100,2)?>%</td>
					<td><?=$word['options'][3]?></td>
					<td><?=$word['options'][4]?></td>
					<td><?=$word['options'][5]?></td>
					<td><?=$word['options'][6]?></td>
					<td><?=$word['options'][7]?></td>
					<td><?=$word['options'][8]?></td>
                    <td><?=$word['options'][9]?></td>
				</tr>
			<?}
			continue;
		}
        if($data['words'][0]['options'][6] === 'unwichtig'){
            $countSkiped++;
            continue;
        }
        if($data['words'][0]['options'][8] !== 'x'){
            $countUnfinished++;
        }
        if(isset($gruppe)){
            if(count($data['words']) < 2){
                continue;
            }
            $found = false;
            foreach($data['words'] as $word){
                if($word['options'][3] == $gruppe){
                    $found = true;
                    break;
                }
            }
            if(!$found){
                continue;
            }
        }
        ?>
        <tr>
            <td class="mainCount"><?=$data['count']?></td>
            <td class="mainPercent"><?=round($data['count']/$parser->numWords*100,2)?>%</td>
            <?if($_GET['detail']){
                if(count($data['words']) > 1){
                $grpLabel = '<td></td></tr>';
                foreach($data['words'] as $word){
                
                    if(in_array($word['options'][3],array_keys($countUniseg['detail']))){
                        $countUniseg['count']++;
                        $countUniseg['detail'][$word['options'][3]]++;
                    };
                    if(in_array($word['options'][3],array_keys($countMultiseg['detail']))){
                        $countMultiseg['count']++;
                        $countMultiseg['detail'][$word['options'][3]]++;
                    };
                    if($word['options'][7] !== 'e'){
                        $countLang['d']++;
                    }else{
                        $countLang['e']++;
                    }
                    if(in_array($word['options'][3],array_keys($countLangShort['detail']))){
                        $countLangShort['count']++;
                        $countLangShort['detail'][$word['options'][3]]['count']++;
                        if($word['options'][7] !== 'e'){
                            $countLangShort['detail'][$word['options'][3]]['d']++;
                            $countLangShort['d']++;
                        }else{
                            $countLangShort['detail'][$word['options'][3]]['e']++;
                            $countLangShort['e']++;
                        }
                    }
                
                    
                    $grpLabel .= '<tr><td></td><td></td><td><span class="word">'.$word['word'].'</span> (<span class="count">'.$word['count'].'</span>|<span class="percent">'.(round($word['count']/$data['count']*100,2)).'%</span>)  </td>';
                    $grpLabel .= '<td>'.$word['options'][3].'</td>';
					if(!$print){
						$grpLabel .= '<td>'.$word['options'][4].'</td>';
					}
					$grpLabel .= '<td>'.$word['options'][5].'</td>';
					if(!$print){
						$grpLabel .= '<td>'.$word['options'][6].'</td>';
						$grpLabel .= '<td>'.$word['options'][7].'</td>';
						$grpLabel .= '<td>'.$word['options'][8].'</td>';
					}
                    $grpLabel .= '</tr>';
                }
                echo $grpLabel;
                ?>
                </tr>
            <?}else{
                $word = $data['words'][0];
                if(in_array($word['options'][3],array_keys($countUniseg['detail']))){
                    $countUniseg['count']++;
                    $countUniseg['detail'][$word['options'][3]]++;
                };
                if(in_array($word['options'][3],array_keys($countMultiseg['detail']))){
                    $countMultiseg['count']++;
                    $countMultiseg['detail'][$word['options'][3]]++;
                };
                
                if($word['options'][7] !== 'e'){
                    $countLang['d']++;
                }else{
                    $countLang['e']++;
                }
                if(in_array($word['options'][3],array_keys($countLangShort['detail']))){
                    $countLangShort['count']++;
                    $countLangShort['detail'][$word['options'][3]]['count']++;
                    if($word['options'][7] !== 'e'){
                        $countLangShort['detail'][$word['options'][3]]['d']++;
                        $countLangShort['d']++;
                    }else{
                        $countLangShort['detail'][$word['options'][3]]['e']++;
                        $countLangShort['e']++;
                    }
                }
            
            ?>
                <td><span class="word"><?=$word['word']?></span> (<span class="count"><?=$word['count']?></span>)</td>
					<td><?=$word['options'][3]?></td>
					<?if(!$print){?>
						<td><?=$word['options'][4]?></td>
					<?}?>
					<td><?=$word['options'][5]?></td>
					<?if(!$print){?>
						<td><?=$word['options'][6]?></td>
						<td><?=$word['options'][7]?></td>
						<td><?=$word['options'][8]?></td>
					<?}?>
                </tr>
            <?}?>
        <?}else{?>
            <td><span class="word"><?=$data['words'][0]['word']?></span> <span class="count"><?=count($data['words']) > 1 && !$print ?'(GRUPPE)' : ''?></span></td>
                <td><?=$data['words'][0]['options'][3]?></td>
				<?if(!$print){?>
					<td><?=$data['words'][0]['options'][4]?></td>
				<?}?>
				<td><?=$data['words'][0]['options'][5]?></td>
				<?if(!$print){?>
					<td><?=$data['words'][0]['options'][6]?></td>
					<td><?=$data['words'][0]['options'][7]?></td>
					<td><?=$data['words'][0]['options'][8]?></td>
				<?}?>
				<?if($data['words'][0]['options'][6] === 'ersetzt'){?>
					<td><?=$data['words'][0]['line']?></td>
				<?}?>
            </tr>
        <?}?>
    <?}?>
    </table>
	<?if(!$print){?>
    <div class="skipped">als unwichtig makiert: <?=$countSkiped?>/<?=count($parser->words)?></div>
    <div class="unfinished">unbearbeitet: <?=$countUnfinished?>/<?=count($parser->words)?></div>
    <div class="users"><?=count($parser->users)?> Charaktere</div>
        <?if($_GET['detail']){?>
        <div class="uniseg">Uniseg - Total: <span class="mainCount"><?=$countUniseg['count']?></span> / <span class="mainPercent">100%</span>
        <?foreach($countUniseg['detail'] as $key => $value){
            echo ' | <span class="word">'.$key.'</span>: <span class="count">'.$value.'</span> (<span class="percent">'.round($value/$countUniseg['count']*100,2).'%</span>)';
        }?>
        </div>
        <div class="uniseg">Multiseg - Total: <span class="mainCount"><?=$countMultiseg['count']?></span> / <span class="mainPercent">100%</span>
        <?foreach($countMultiseg['detail'] as $key => $value){
            echo ' | <span class="word">'.$key.'</span>: <span class="count">'.$value.'</span> (<span class="percent">'.round($value/$countMultiseg['count']*100,2).'%</span>)';
        }?>
        </div>
        <div class="language"><span class="word">Sprache </span>- Deutsch: <span class="mainCount"><?=$countLang['d']?></span> (<span class="percent"><?=round($countLang['d']/($countLang['d']+$countLang['e'])*100,2)?>%</span>) | English: <span class="count"><?=$countLang['e']?></span> (<span class="percent"><?=round($countLang['e']/($countLang['d']+$countLang['e'])*100,2)?>%</span>)</div>   
        <div class="abrev">
            <div>
                <span class="word">Abk&uuml;rzungen</span>: 
                <span class="mainCount"><?=$countLangShort['count']?></span>- Deutsch: 
                <span class="count"><?=$countLangShort['d']?> </span>
                (<span class="percent"><?=round($countLangShort['d']/($countLangShort['d']+$countLangShort['e'])*100,2)?>%</span>) | English: 
                <span class="count"><?=$countLangShort['e']?> </span>
                (<span class="percent"><?=round($countLangShort['e']/($countLangShort['d']+$countLangShort['e'])*100,2)?>%</span>)
            </div>
            <?foreach($countLangShort['detail'] as $key => $value){?>
                <div>
                    <span class="word"><?=$key?> - Total: </span>
                    <span class="mainCount"><?=$value['count']?> </span>
                    | Deutsch: <span class="count"><?=$value['d']?> </span>
                    (<span class="percent"><?=round($value['d']/($value['d']+$value['e'])*100,2)?> %</span>) 
                    | English: <span class="count"><?=$value['e']?> </span>
                    (<span class="percent"><?=round($value['e']/($value['d']+$value['e'])*100,2)?> %</span>)
                </div>
            <?}?>
        </div>
        <?}?>
	<?}?>
</div>
<style type="text/css">
    *{
        font-family:verdana;
        font-size:13px;
		<?if($print){
			echo 'font-size:10px !important;';
		}?>
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
<script type="text/javascript" src="http://jquery.com/jquery-wp-content/themes/jquery/js/jquery-1.9.1.min.js"></script>