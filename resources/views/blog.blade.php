@extends('layouts.master')

@section('facebook_meta')
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="Blog" />
    <meta property="og:description"        content="Blog" />
    <meta property="og:image"              content="" />
@endsection

@section('twitter_card_meta')
	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="Blog">
	<meta name="twitter:description" content="Blog">
	<meta name="twitter:image" content="">
	<meta name="twitter:url" content="{{url()->current()}}" />
@endsection

@section('page-title')
Blog
@endsection
@section('mainContent')
    <section>
      <div class="container max-con">
        <div class="order-pagination">
          <ul>
            <li><a href="#home">Home ></a></li>
            <li><a href="#shop">Blog</a></li>
          </ul>
        </div>
        <div class="row">
          <div class="col-xl-8 col-lg-8 col-md-8 col-sm-7">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="blog-calendar">
                  <span>16</span>
                  <p>jan</p>
                </div>
                <div class="blog-main">
                  <img src="/frontend/assets/img/new.png">
                  <a href="#"><h5>Why I say old chap that is.</h5></a>
                  <p>Only a quid bobby brilliant bugger Jeffrey owt to do with me lurgy blimey.!</p>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="read-more">
                      <a href="/bloginside.html"><p>READ MORE<i class="fas fa-arrow-right"></i></p></a>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="blog-comment">
                      <a href="#"><p><i class="far fa-comment"></i>14 COMMENTS</p></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="blog-calendar">
                  <span>16</span>
                  <p>jan</p>
                </div>
                <div class="blog-main">
                  <img src="/frontend/assets/img/adsproduct.png">
                  <a href="#"><h5>Why I say old chap that is.</h5></a>
                  <p>Only a quid bobby brilliant bugger Jeffrey owt to do with me lurgy blimey.!</p>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="read-more">
                      <a href="/bloginside.html"><p>READ MORE<i class="fas fa-arrow-right"></i></p></a>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="blog-comment">
                      <a href="#"><p><i class="far fa-comment"></i>14 COMMENTS</p></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="blog-calendar">
                  <span>16</span>
                  <p>jan</p>
                </div>
                <div class="blog-main">
                  <img src="/frontend/assets/img/Image_05.png">
                  <a href="#"><h5>Why I say old chap that is.</h5></a>
                  <p>Only a quid bobby brilliant bugger Jeffrey owt to do with me lurgy blimey.!</p>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="read-more">
                      <a href="/bloginside.html"><p>READ MORE<i class="fas fa-arrow-right"></i></p></a>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="blog-comment">
                      <a href="#"><p><i class="far fa-comment"></i>14 COMMENTS</p></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="blog-calendar">
                  <span>16</span>
                  <p>jan</p>
                </div>
                <div class="blog-main">
                  <img src="/frontend/assets/img/Product_Image_02.png">
                  <a href="#"><h5>Why I say old chap that is.</h5></a>
                  <p>Only a quid bobby brilliant bugger Jeffrey owt to do with me lurgy blimey.!</p>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="read-more">
                      <a href="/bloginside.html"><p>READ MORE<i class="fas fa-arrow-right"></i></p></a>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="blog-comment">
                      <a href="#"><p><i class="far fa-comment"></i>14 COMMENTS</p></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="blog-calendar">
                  <span>16</span>
                  <p>jan</p>
                </div>
                <div class="blog-main">
                  <img src="/frontend/assets/img/Product_Image_03.png">
                  <a href="#"><h5>Why I say old chap that is.</h5></a>
                  <p>Only a quid bobby brilliant bugger Jeffrey owt to do with me lurgy blimey.!</p>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="read-more">
                      <a href="/bloginside.html"><p>READ MORE<i class="fas fa-arrow-right"></i></p></a>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="blog-comment">
                      <a href="#"><p><i class="far fa-comment"></i>14 COMMENTS</p></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="blog-calendar">
                  <span>16</span>
                  <p>jan</p>
                </div>
                <div class="blog-main">
                  <img src="/frontend/assets/img/new.png">
                  <a href="#"><h5>Why I say old chap that is.</h5></a>
                  <p>Only a quid bobby brilliant bugger Jeffrey owt to do with me lurgy blimey.!</p>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="read-more">
                      <a href="/bloginside.html"><p>READ MORE<i class="fas fa-arrow-right"></i></p></a>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="blog-comment">
                      <a href="#"><p><i class="far fa-comment"></i>14 COMMENTS</p></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <nav aria-label="Page navigation example">
              <ul class="pagination blog-pagination">
                <li class="page-item">
                  <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                  </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                  <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-5 sidebarhide">
            <div class="blog-sidebar">
              <div class="input-group input-append p-0">
                <input type="search" placeholder="Search Blog">
              </div>
              <div class="input-group-btn input-append-btn">
                <button type="button">
                <i class="fa fa-search"></i>
                </button>
              </div>
              <h6>Recent Posts</h6>
              <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4">
                  <div class="side-image">
                    <img src="/frontend/assets/img/Product098.png">
                  </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-8 col-sm-8">
                  <div class="side-info">
                    <a href="#"><p>Fast App development</p></a>
                    <span>JULY 06, 2019</span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4">
                  <div class="side-image">
                    <img src="/frontend/assets/img/Product_Image_05.png">
                  </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-8 col-sm-8">
                  <div class="side-info">
                    <a href="#"><p>Fast App development</p></a>
                    <span>JULY 06, 2019</span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4">
                  <div class="side-image">
                    <img src="/frontend/assets/img/Product_Image_07.png">
                  </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-8 col-sm-8">
                  <div class="side-info">
                    <a href="#"><p>Fast App development</p></a>
                    <span>JULY 06, 2019</span>
                  </div>
                </div>
              </div>
              <div class="sidebar-categories">
                <h5>Categories</h5>
                <ul>
                  <a href="#"><li>Fashion<span>(24)</span></li></a>
                  <a href="#"><li>gaming<span>(09)</span></li></a>
                  <a href="#"><li>food for thought<span>(07)</span></li></a>
                  <a href="#"><li>uncategorized<span>(03)</span></li></a>
                  <a href="#"><li>orderpak vendors<span>(04)</span></li></a>
                  <a href="#"><li>wireframing<span>(24)</span></li></a>
                </ul>
              </div>
              <aside class="blog-widget">
                <h4 class="blog-title">Tags</h4>
                <ul class="list">
                  <li>
                    <a href="#">orderpak</a>
                  </li>
                  <li>
                    <a href="#">Web Design</a>
                  </li>
                  <li>
                    <a href="#">Cooling System </a>
                  </li>
                  <li>
                    <a href="#">orders</a>
                  </li>
                  <li>
                    <a href="#">Landing</a>
                  </li>
                  <li>
                    <a href="#">Corporate</a>
                  </li>
                  <li>
                    <a href="#">Wheels</a>
                  </li>
                </ul>
              </aside>
              <div class="insta-blog">
                <h5>Instagram</h5>
                <div class="row">
                  <div class="col-4">
                    <img src="/frontend/assets/img/Product07.png">
                  </div>
                  <div class="col-4">
                    <img src="/frontend/assets/img/Product07.png">
                  </div>
                  <div class="col-4">
                    <img src="/frontend/assets/img/Product07.png">
                  </div>
                </div>
                <div class="row">
                  <div class="col-4">
                    <img src="/frontend/assets/img/Product07.png">
                  </div>
                  <div class="col-4">
                    <img src="/frontend/assets/img/Product07.png">
                  </div>
                  <div class="col-4">
                    <img src="/frontend/assets/img/Product07.png">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection