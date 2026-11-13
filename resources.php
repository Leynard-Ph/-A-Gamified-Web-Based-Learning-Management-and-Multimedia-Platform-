<?php
require_once __DIR__.'/config/database.php';
$items=$conn->query('SELECT * FROM resources ORDER BY sort_order,id')->fetchAll();
function resource_video_embed(string $url): ?string {
 $parts=parse_url($url);$host=strtolower($parts['host']??'');$path=$parts['path']??'';$id='';
 if(in_array($host,['youtu.be','www.youtu.be'],true))$id=trim($path,'/');
 if(in_array($host,['youtube.com','www.youtube.com','m.youtube.com'],true)){
  if(($parts['path']??'')==='/watch'){parse_str($parts['query']??'',$query);$id=(string)($query['v']??'');}
  elseif(preg_match('~^/(embed|shorts)/([A-Za-z0-9_-]+)~',$path,$m))$id=$m[2];
 }
 return preg_match('/^[A-Za-z0-9_-]{11}$/',$id)?'https://www.youtube-nocookie.com/embed/'.$id:null;
}
$pageTitle='Resources';$activeNav='resources';require __DIR__.'/partials/header.php'; ?>
<section class="page-hero"><div class="page-hero-inner"><span class="eyebrow">TOOLS FOR YOUR NEXT STEP</span><h1>Resources to keep exploring.</h1><p>Use trusted tools and references to extend the concepts from each lesson.</p></div></section>
<section class="content-wrap"><div class="resource-grid"><?php foreach($items as $i=>$x): $url=(string)($x['url']??'');$embed=resource_video_embed($url);$isVideo=str_contains(strtolower($x['kind']),'video');$isFile=$isVideo&&preg_match('/\.(mp4|webm|ogg)(\?.*)?$/i',$url); ?><article class="resource-card"><span class="resource-icon"><?= ['01','02','03','04'][$i%4] ?></span><span class="category-chip"><?= e($x['kind']) ?></span><h2><?= e($x['title']) ?></h2><p><?= e($x['description']) ?></p><?php if($embed&&$isVideo): ?><div class="video-frame"><iframe src="<?= e($embed) ?>" title="<?= e($x['title']) ?>" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe></div><?php elseif($isFile): ?><video class="resource-video" controls preload="metadata"><source src="<?= e($url) ?>"></video><?php elseif(filter_var($url,FILTER_VALIDATE_URL)&&in_array(parse_url($url,PHP_URL_SCHEME),['http','https'],true)): ?><a class="text-link" href="<?= e($url) ?>" target="_blank" rel="noopener noreferrer">Open resource ↗</a><?php else: ?><span class="muted">Use the practice labs to get started.</span><?php endif; ?></article><?php endforeach; ?></div></section><?php require __DIR__.'/partials/footer.php'; ?>

