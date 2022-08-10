@extends('layouts.master')

@section('facebook_meta')
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="Blog" />
    <meta property="og:description"        content="Blog" />
    <meta property="og:image"              content="" />
@endsection

@section('page-title')
Blog Detail
@endsection
@section('mainContent')
    <section>
      <div class="container max-con">
        <div class="order-pagination">
          <ul>
            <li><a href="#">Home ></a></li>
            <li><a href="#">BlogInside</a></li>
          </ul>
        </div>
        <div class="row">
          <div class="col-lg-8 col-md-8 col-sm-12">
            <div class="blog-inside-main">
              <h5>Lorem ipsum dolor sit amet, consetetur sadipscing elitr</h5>
              <div class="bloginside-calendar-main">
                <span>16</span>
                <p>jan</p>
              </div>
              <img src="/frontend/assets/img/Productnew.png">
              <p>Why I say old chap that is, spiffing jolly good a load of old tosh spend a penny tosser arse over tit, excuse my French owt to do with me up the kyver matie boy at public school. Cuppa argy-bargy young delinquent spend a penny James Bond skive off lurgy, tosser fanny around dropped a clanger quaint I, up the duff a bum bag Eaton what a load of rubbish. Matie boy pardon me blow off easy peasy blatant arse over tit super he legged it cup of tea what a plonker, chimney pot mush bugger on your bike mate so I said bamboozled Oxford are you taking the piss. Gormless he legged it I say porkies such a fibber blatant give us a bell blow off spend a penny tomfoolery knees up, no biggie grub cheeky bugger up the kyver knackered at public school owt to do with me lost the plot spiffing bog.</p>
              <p>Cras mush pardon you knees up he lost his bottle it's all gone to pot faff about porkies arse, barney argy-bargy cracking goal loo cheers spend a penny bugger all mate in my flat, hunky-dory well get stuffed mate David morish bender lavatory. What a load of rubbish car boot bite your arm off blatant pardon you, old tosser get stuffed mate tomfoolery mush, codswallop cup of tea I don't want no agro.!</p>
              <blockquote class="wp-block-quote">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                <em>PHILLIP ANTHROPY</em>
              </blockquote>
              <p>Cras mush pardon you knees up he lost his bottle it's all gone to pot faff about porkies arse, barney argy-bargy cracking goal loo cheers spend a penny bugger all mate in my flat, hunky-dory well get stuffed mate David morish bender lavatory. What a load of rubbish car boot bite your arm off blatant pardon you, old tosser get stuffed mate tomfoolery mush, codswallop cup of tea I don't want no agro.!</p>
              <div class="share-comment">
                <div class="row">
                  <div class="col-6">
                    <div class="bloginside-share">
                      <p><span>SHARE :</span><span><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-vimeo"></i></a><a href="#"><i class="fa fa-linkedin"></i></a></span></p>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="bloginside-comment">
                      <a href="#"><p><i class="far fa-comment"></i>14 COMMENTS</p></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="bloginside-profile">
              <div class="row">
                <div class="col-3">
                  <div class="probile-image">
                    <img src="/frontend/assets/img/11-layers.png" alt="">
                  </div>
                </div>
                <div class="col-9">
                  <div class="profile-info">
                    <h5>Bodrum Salvador</h5>
                    <p>Tinkety tonk old fruit Harry gormless morish Jeffrey what a load of rubbish burke what a plonker hunky.!</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="bloginside-related">
              <h4>Related Post</h4>
              <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                  <div class="bloginside-calendar">
                    <span>16</span>
                    <p>jan</p>
                  </div>
                  <div class="bloginside-main">
                    <img src="/frontend/assets/img/new.png">
                    <a href="#"><h5>Why I say old chap that is.</h5></a>
                    <p>Only a quid bobby brilliant bugger Jeffrey owt to do with me lurgy blimey.!</p>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                  <div class="bloginside-calendar">
                    <span>16</span>
                    <p>jan</p>
                  </div>
                  <div class="bloginside-main">
                    <img src="/frontend/assets/img/new.png">
                    <a href="#"><h5>Why I say old chap that is.</h5></a>
                    <p>Only a quid bobby brilliant bugger Jeffrey owt to do with me lurgy blimey.!</p>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                  <div class="bloginside-calendar">
                    <span>16</span>
                    <p>jan</p>
                  </div>
                  <div class="bloginside-main">
                    <img src="/frontend/assets/img/new.png">
                    <a href="#"><h5>Why I say old chap that is.</h5></a>
                    <p>Only a quid bobby brilliant bugger Jeffrey owt to do with me lurgy blimey.!</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="comment-section">
              <h4>2 Comment</h4>
            </div>
            <div class="comment-section-inside">
              <div class="row">
                <div class="col-2">
                  <div class="comment-image">
                    <img src="/frontend/assets/img/12-layers.png" alt="">
                  </div>
                </div>
                <div class="col-10">
                  <div class="comment-info">
                    <div class="row">
                      <div class="col-6">
                        <div class="comment-section-info">
                          <h5>Fletch Skinner</h5>
                          <p>Just Now</p>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="comment-reply">
                          <a href="#"><p>REPLY<i class="fas fa-arrow-right"></i></p></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="new-inside-pera">
                    <p>Cuppa the bee's knees the full monty bloke cockup pear shaped bubble and squeak lavatory naff, chip shop bodge burke do one have.!</p>
                    <hr>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-3">
                  <div class="comment-reply-image">
                    <img src="/frontend/assets/img/16-layers.png" alt="">
                  </div>
                </div>
                <div class="col-9">
                  <div class="comment-reply-info">
                    <div class="row">
                      <div class="col-6">
                        <div class="comment-section-info-2">
                          <h5>Fletch Skinner</h5>
                          <p>Just Now</p>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="comment-reply">
                          <a href="#"><p>REPLY<i class="fas fa-arrow-right"></i></p></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="new-inside-pera-2">
                    <p>Cuppa the bee's knees the full monty bloke cockup pear shaped bubble and squeak lavatory naff, chip shop bodge burke do one have.!</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="comment-section-inside-2">
              <div class="row">
                <div class="col-2">
                  <div class="comment-image">
                    <img src="/frontend/assets/img/12-layers.png" alt="">
                  </div>
                </div>
                <div class="col-10">
                  <div class="comment-info">
                    <div class="row">
                      <div class="col-6">
                        <div class="comment-section-info">
                          <h5>Fletch Skinner</h5>
                          <p>Just Now</p>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="comment-reply">
                          <a href="#"><p>REPLY<i class="fas fa-arrow-right"></i></p></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="new-inside-pera">
                    <p>Cuppa the bee's knees the full monty bloke cockup pear shaped bubble and squeak lavatory naff, chip shop bodge burke do one have.!</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="leave-comment">
              <h5>Leave a Comment</h5>
            </div>
            <div class="inside-leave-input">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <input type="fname" class="form-control" id="exampleInputfName" aria-describedby="fNameHelp" placeholder="Name">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" placeholder="Comment"></textarea>
              </div>
              <a href="#"><button type="button" class="btn btn-light">Post Comment</button></a>
            </div>
          </div>
          <div class="col-4 sidebarhide">
            <div class="blog-sidebar">
              <div class="input-group input-append p-0">
                <input type="search" placeholder="search Blog">
              </div>
              <div class="input-group-btn input-append-btn">
                <button type="button">
                <i class="fa fa-search"></i>
                </button>
              </div>
              <h6>Recent Posts</h6>
              <div class="row">
                <div class="col-4">
                  <div class="side-image">
                    <img src="/frontend/assets/img/Product098.png">
                  </div>
                </div>
                <div class="col-8 pl-0">
                  <div class="side-info">
                    <a href="#"><p>Fast App development</p></a>
                    <span>JULY 06, 2019</span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-4">
                  <div class="side-image">
                    <img src="/frontend/assets/img/Product_Image_05.png">
                  </div>
                </div>
                <div class="col-8 pl-0">
                  <div class="side-info">
                    <a href="#"><p>Fast App development</p></a>
                    <span>JULY 06, 2019</span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-4">
                  <div class="side-image">
                    <img src="/frontend/assets/img/Product_Image_07.png">
                  </div>
                </div>
                <div class="col-8 pl-0">
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