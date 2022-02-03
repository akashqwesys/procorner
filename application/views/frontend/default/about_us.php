<section class="p-0">
    <div class="container-md">
        <div class="row align-items-center pb-0 mb-0">
            <div class="col-md-6 banner-title">
                <h2 class="fw-bold">Our<span> Story</span></h2>
                <p><b>Impeccable skill-building courses for IT Professionals, Women, and Businesses.</b></p>
                <p>Our founder ran an IT company in 2013. He realized that many people got into the IT field but only a few could make it in the long run. The issues of all who quit IT were similar; they couldn’t adapt to the evolving needs in the IT-sphere. These were the difficulties identified</p>
                <p>1. No resources for skill-building in their regional languages.<br>OR<br>2. Outdated education.</p>    
                <!-- <form class="" action="<?php echo site_url('home/search'); ?>" method="get">
                    <div class="input-group ">
                        <input type="text" class="form-control" name="query" placeholder="<?php echo site_phrase('what_do_you_want_to_learn'); ?>?" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <span class="input-group-text btn" id="basic-addon2" type="submit"><?php echo site_phrase('search'); ?></span>
                        </div>
                    </div>
                </form> -->
            </div>
            <div class="col-md-6">
                <img src="../assets/frontend/default/img/About-us.png" width="100%">
            </div>
        </div>
    </div>
</section>
<section class="timeline">
<h3 class="text-center">Timeline</h2>
  <ul>
    <li class="li-2016">
      <div class="div-2016">
        <time>2016</time> This year saw the birth of PROCORNER EDUFLEX. We established our ventures by prioritizing the following things 
        
        <p><br><b>1.</b> Reach out to 70% of the audience who don't have enough resources in the Hindi Language. (In India, only 30% of people understand English.) They have brilliant minds but due to fewer resources, feel backward or illiterate</p>
        <p><br><b>2.</b> Level up IT professionals with the latest technical knowledge.</p>
        <p><br><b>3.</b> Empower women by providing home-based earning opportunity courses.</p>
        
      </div>
    </li>
    <li class="li-2017">
    <div class="div-2017">
        <time>2017</time> We were now a team of 30 passionate individuals focused on building a set of core values on which our venture could flourish. We started creating courses based on these values and worked diligently to make them better, day-by-day. We provided the courses to students locally and tweaked them according to the feedback we received. The courses turned out to be very effective!

      </div>
    </li>
    <li class="li-2018">
    <div class="div-2018">
        <time>2018</time> By this year, we had provided courses to 500+ students. The feedback that we received was overwhelming. One of our students strategically applied this course knowledge in his family business. Needless to say, he benefited immensely! He further continued enrolling in our courses and now he has seen success in his career. We were also awarded “Startup India” Recognised By DIPP (Government Body) in February of the same year. 2018 saw many such success stories and we decided to expand our venture even further.

      </div>
    </li>
    <li class="li-2019">
    <div class="div-2019">
        <time>2019</time>This year there were many new advancements in the IT sector. Alongside there was also a hike in people using digital marketing for their businesses and brands. Digital marketing did not require any specific educational qualifications. Understanding Human Psychology and Marketing Strategically were the two important aspects of it. We studied this extensively and curated courses revolving around these topics. Also, our IT courses continued benefitting people.
      </div>
    </li>
    <li class="li-2020">
    <div class="div-2020">
        <time>2020</time> In this year we realized the importance of niching down and hence, creating courses for a specific requirement. At this point, Ed-tech startups saw exponential growth owing to the pandemic. We studied those startups and focused on strengthening our USPs. We created our courses on YouTube, LinkedIn, Upwork, etc., and started providing them to our students. We asked for their feedback and continued bettering our courses.
      </div>
    </li>
    <li class="li-2021">
    <div class="div-2021">
        <time>2021</time> We decided on publicly launching our courses. We designed our website and started curating content that would benefit people. Our beliefs had strengthened further on. We always believed that we had the scope of growth in every project of ours. So, we tried to reach our top potential. Owing to the pandemic, we are proudly starting this venture in 2022!
      </div>
    </li>
    <li class="in-view-2022-mission li-2022-mission">
    <div class="div-2022-mission">
        <time>Mission - 2022</time> Our mission is to educate IT professionals and equip them with advanced facilities, empower women by providing them skills to earn from home and also create Hindi courses so a large chunk of India can get better access to quality knowledge. We are also targeted on providing superior quality knowledge that: STUDENTS recommend to peers and acquaintances, WOMEN prefer for their career, BUSINESSES select for their employees, and IT PROFESSIONALS can use for their career!
      </div>
    </li>
    <li class="in-view-2022-vision li-2022-vision">
    <div class="div-2022-vision">
        <time>Vision - 2022</time> Our vision is to reach as many individuals out there struggling to find a purpose in their life because of certain conditions. We hope to provide them with quality knowledge that strengthens the base for their professional journey. 
We have built this brand with the belief that everyone is capable of reaching the limits of the sky. We further wish to take these strong values to every individual unsatisfied with his/her professional life.

    </li>    
  </ul>
</section>

<script>
    (function () {
  "use strict";

  // define variables
  var items = document.querySelectorAll(".timeline li");
  function isElementInViewport(el) {
    var rect = el.getBoundingClientRect();
    return (
      rect.top >= 0 &&
      rect.left >= 0 &&
      rect.bottom <=
        (window.innerHeight || document.documentElement.clientHeight) &&
      rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
  }

  function callbackFunc() {
      var j=2015;
    for (var i = 0; i < items.length; i++) {
        j=j+1;
      if (isElementInViewport(items[i])) {
        items[i].classList.add("in-view");        
        items[i].classList.add("in-view-"+j);
      }
    }
  }

  // listen for events
  window.addEventListener("load", callbackFunc);
  window.addEventListener("resize", callbackFunc);
  window.addEventListener("scroll", callbackFunc);
})();

</script>


