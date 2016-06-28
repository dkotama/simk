@extends('conferences.shows.layout')

@section('content')
<h2 id="sec0">{{ $conf->name }} Overview</h2>
  <hr class="col-md-12">
  Rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae 
  dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia cor magni dolores 
  eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, 
  sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. 
  Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut.              
  Rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae 
  dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia cor magni dolores 
  eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, 
  sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. 
  Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut!
  

  <hr> 
  <h2 id="sec1">Latest News</h2> 
  <hr>
  <ul class="media-list">
    <li class="media">
     <div class="media-left ">
        <a href="#">
          <img class="media-object" src="/images/illust64.jpg" data-src="..." alt="Generic placeholder image">
        </a>
      </div>
      <div class="media-body">
        <a href="#"><h4 class="media-heading">This is latest news title</h4></a>                     
        <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc <a href="#">read more..</a></p>
      </div> 
    </li> 
    <li class="media">
     <div class="media-left ">
        <a href="#">
          <img class="media-object" src="/images/illust64.jpg" data-src="..." alt="Generic placeholder image">
        </a>
      </div>
      <div class="media-body">
        <a href="#"><h4 class="media-heading">Top aligned media</h4></a>                     
        <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc <a href="#">read more..</a></p>
      </div> 
    </li> 
  </ul>

  <hr>              
@endsection
