<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">TESTE</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
<?php
  
  $pages = ['home' => 'Home', 'sobre' => 'Sobre', 'servicos' => 'Serviços', 'contato' => 'Contato', 'admin' => 'Admin'];
    
  $uri = urldecode(filter_input(INPUT_SERVER, 'PATH_INFO', FILTER_DEFAULT));

  if ( $uri ):
    $params = explode('/', substr($uri, 1));
    $page = 'includes/pages/'.$params[0].'.php';
  endif;

  $link = $params[0] ?? '';


  foreach ($pages as $k => $v):
    if ($link == $k):
      echo '<li class="nav-item active">';
      echo '  <a class="nav-link" href="/'.$k.'">'.$v.' <span class="sr-only">(current)</span></a>';
      echo '</li>';
    else:
      echo '<li class="nav-item">';
      echo '  <a class="nav-link" href="/'.$k.'">'.$v.'</a>';
      echo '</li>';
    endif;  
  endforeach;
/*
  foreach ($pages as $k => $v):
    if ($link == $k):
?>      
      <li class="nav-item active">
        <a class="nav-link" href="/<?php echo $k; ?>"><?php echo $v; ?> <span class="sr-only">(current)</span></a>
      </li>
<?php      
    else:
?>      
      <li class="nav-item">
         <a class="nav-link" href="/<?php echo $k; ?>"><?php echo $v; ?></a>
      </li>
<?php
    endif;  
  endforeach;
*/    
 ?>      
    </ul>
  </div>
</nav>