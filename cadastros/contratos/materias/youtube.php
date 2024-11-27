<?php
session_start();
require_once '../../../init.php';
require '../../../check.php';
require '../../../classes/youtube.class.php';
$yt = new YouTubeDownloader();
$downloadLinks ='';
$error='';
if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $videoLink = $_GET['video_link'];

    if(!empty($videoLink)) {
        $vid = $yt->getYouTubeCode($videoLink);        
        if($vid) {
            $result = $yt->processVideo($vid);            
            if($result) {
                //print_r($result);
                $info = $result['videos']['info'];
                $formats = $result['videos']['formats'];
                $adapativeFormats = $result['videos']['adapativeFormats'];                

                $videoInfo = json_decode($info['player_response']);

                $title = $videoInfo->videoDetails->title;
                $description = $videoInfo->videoDetails->shortDescription;
                $thumbnail = $videoInfo->videoDetails->thumbnail->thumbnails{0}->url;
            }
            else {
                $error = "Algo deu errado. Verifique se a URL está correta.";
            }

        }
    } else {
        $error = "Por favor, insira um link de YouTube.";
    }
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no">
        <title>DataWork &middot; Download de Vídeo YouTube</title>   
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.css" rel="stylesheet">    
    </head>
    <body>
        <div class="container">
            <form method="get">
                <div class="row mt-5 mb-5">
                    <div class="col-lg-12">
                        <h4>Download de Vídeo YouTube</h4>
                    </div>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <input type="url" class="form-control" name="video_link" placeholder="Cole o link, por exemplo: https://www.youtube.com/watch?v=OK_JCtrrv-c" value="<?php echo $videoLink;?>">
                            <div class="input-group-append">
                                <button type="submit" name="submit" id="submit" class="btn btn-primary">Baixar Vídeo</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <?php if($error) :?>
                <div style="color:red;font-weight: bold;text-align: center"><?php print $error?></div>
            <?php endif;?>

            <?php if(!empty($formats)):?>
            <div class="row mb-3">
                <div class="col-md-3 col-lg-3 mb-2">
                   <a href="<?php print $videoLink; ?>" target="_blank"><img src="<?php print $thumbnail; ?>"></a>
                </div>
                <div class="col-md-9 col-lg-9 mb-2">
                    <h4><?php print $title;?></h4>
                    <small><?php print substrwords($description,250);?></small>
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-header">
                    <strong>Com Vídeo e Som</strong>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Tipo</td>
                            <td>Qualidade</td>
                            <td>Download</td>
                        </tr>
                        <?php foreach ($formats as $video) :?>
                            <tr>
                                <td><?php print $video['type']?></td>
                                <td><?php print $video['quality']?></td>
                                <td>
                                    <?php if ($video['link'] === null) {
                                        echo "<div style='color:red'>Indisponível</div>";
                                    } else {
                                        ?>
                                        <a href="youtube_downloader/downloader.php?link=<?php print urlencode($video['link'])?>&title=<?php print urlencode($title)?>&type=<?php print urlencode($video['type'])?>">Download</a>
                                        <?php 
                                    }; ?>
                                </td>                                
                            </tr>
                        <?php endforeach;?>
                    </table>
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-header">
                    <strong>Somente Vídeos / Somente Áudios</strong>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Tipo</td>
                            <td>Qualidade</td>
                            <td>Download</td>
                        </tr>
                        <?php foreach ($adapativeFormats as $video) :?>
                            <tr>
                                <td><?php print $video['type']?></td>
                                <td><?php print $video['quality']?></td>
                                <td>
                                    <?php if ($video['link'] === null) {
                                        echo "<div style='color:red'>Indisponível</div>";
                                    } else {
                                        ?>
                                        <a href="youtube_downloader/downloader.php?link=<?php print urlencode($video['link'])?>&title=<?php print urlencode($title)?>&type=<?php print urlencode($video['type'])?>">Download</a>
                                        <?php 
                                    }; ?>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </table>
                </div>
            </div>
            <?php endif;?>
        </div>
    </body>
</html>