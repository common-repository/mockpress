<?php require_once MOCKPRESS_PATH . 'admin/manager/header.php';?>

<style>
.status-button{
    background: linear-gradient(0deg, #b50b0b, #ff0000);
    border-radius: 20px;
   /* width: 98px;*/
    height: 38px;
    display: flex;
    justify-content: center;
    align-items: center;
    text-decoration: none;
    color: white;
    font-weight: bold;
    padding: 10px;
    margin-right: 50px;
  }
  .warning-suspended{
    text-align: right;
    padding-right: 30px;
    color: #e12805;
    font-weight: bold;
    font-size: medium;
    animation: myAnim 3s infinite;
  }

  @keyframes myAnim {
  0%,
  50%,
  100% {
    opacity: 1;
  }

  25%,
  75% {
    opacity: 0;
  }
}

</style>



<div class="container card1" id="navigation">
  <div class="row">
    <div class="col-md-12">
      <div class="group1">
        <div class="home">
          <a id="c_home" style="cursor:pointer">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M21.38 5.95663L14.66 1.25497C12.8283 -0.0283654 10.0167 0.0416348 8.25499 1.40663L2.40999 5.9683C1.24332 6.8783 0.321655 8.74497 0.321655 10.215V18.265C0.321655 21.24 2.73666 23.6666 5.71166 23.6666H18.2883C21.2633 23.6666 23.6783 21.2516 23.6783 18.2766V10.3666C23.6783 8.79164 22.6633 6.85497 21.38 5.95663ZM12.875 19C12.875 19.4783 12.4783 19.875 12 19.875C11.5217 19.875 11.125 19.4783 11.125 19V15.5C11.125 15.0216 11.5217 14.625 12 14.625C12.4783 14.625 12.875 15.0216 12.875 15.5V19Z" fill="#7A6EF0" />
            </svg>
            <span style="vertical-align:middle; display:inline;margin-left:10px;">Home</span>
          </a>
        </div>
        <div class="license">
          <a id="c_license" style="cursor:pointer">
            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M18.8883 2.33337H9.11165C4.86498 2.33337 2.33331 4.86504 2.33331 9.11171V18.8767C2.33331 23.135 4.86498 25.6667 9.11165 25.6667H18.8766C23.1233 25.6667 25.655 23.135 25.655 18.8884V9.11171C25.6666 4.86504 23.135 2.33337 18.8883 2.33337ZM9.54331 19.565C9.51998 19.565 9.48498 19.565 9.46165 19.565C8.32998 19.46 7.26831 18.935 6.47498 18.095C4.60831 16.135 4.60831 12.95 6.47498 10.99L9.02998 8.30671C9.93998 7.35004 11.165 6.81337 12.4716 6.81337C13.7783 6.81337 15.0033 7.33837 15.9133 8.30671C17.78 10.2667 17.78 13.4517 15.9133 15.4117L14.6416 16.7534C14.3033 17.1034 13.755 17.115 13.405 16.7884C13.055 16.45 13.0433 15.9017 13.37 15.5517L14.6416 14.21C15.8783 12.915 15.8783 10.8034 14.6416 9.52004C13.4866 8.30671 11.4566 8.30671 10.29 9.52004L7.73498 12.2034C6.49831 13.4984 6.49831 15.61 7.73498 16.8934C8.23665 17.43 8.91331 17.7567 9.62498 17.8267C10.1033 17.8734 10.4533 18.305 10.4066 18.7834C10.3716 19.2267 9.98665 19.565 9.54331 19.565ZM21.525 17.0217L18.97 19.705C18.06 20.6617 16.835 21.1984 15.5283 21.1984C14.2216 21.1984 12.9966 20.6734 12.0866 19.705C10.22 17.745 10.22 14.56 12.0866 12.6L13.3583 11.2584C13.6966 10.9084 14.245 10.8967 14.595 11.2234C14.945 11.5617 14.9566 12.11 14.63 12.46L13.3583 13.8017C12.1216 15.0967 12.1216 17.2084 13.3583 18.4917C14.5133 19.705 16.5433 19.7167 17.71 18.4917L20.265 15.8084C21.5016 14.5134 21.5016 12.4017 20.265 11.1184C19.7633 10.5817 19.0866 10.255 18.375 10.185C17.8966 10.1384 17.5466 9.70671 17.5933 9.22837C17.64 8.75004 18.06 8.38837 18.55 8.44671C19.6816 8.56337 20.7433 9.07671 21.5366 9.91671C23.3916 11.865 23.3916 15.0617 21.525 17.0217Z" fill="#29343E" />
            </svg>
            <span style="vertical-align:middle; display:inline;margin-left:10px;">License</span>
          </a>
        </div>
      </div>
      <div class="group2">
        <div style="display: none;" id="suspended-1" class="status-button">Suspended</div>
        <img src="<?php echo MOCKPRESS_URL . 'admin/assets/img/Group 87.svg'; ?>">
        <a href="https://mockpress.id">
          <div class="btn"><?php echo MOCKPRESS_VERSION; ?></div>
        </a>
      </div>
    </div>
  </div>
</div>
  <p id="suspended-2" style="display: none;" class="warning-suspended">Akun anda tersuspend, mohon hubungin admin untuk lebih lanjut...</p>

<div id="home" class="tab">
  <div class="container container2">
    <div class="text">
      <h1>Read-First.</h1>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <img src="<?php echo MOCKPRESS_URL . 'admin/assets/img/Mouse Idea.png'; ?>" class="img1">
          <div class="group">
            <h2>Tutorial</h2>
            <p>Tutorial, Documentation, How to use.</p>
            <a href="https://mockpress.id/tutorial" target="_blank">
              <div class="btn">
                See details
                <img src="<?php echo MOCKPRESS_URL . 'admin/assets/img/export.svg'; ?>">
              </div>
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <img src="<?php echo MOCKPRESS_URL . 'admin/assets/img/Feedback.png'; ?>" class="img1">
          <div class="group">
            <h2>Customer Services</h2>
            <p>Have a Question? Ask anything.</p>
            <a href="https://api.whatsapp.com/send?phone=62895617062302" target="_blank">
              <div class="btn">
                See details
                <img src="<?php echo MOCKPRESS_URL . 'admin/assets/img/export.svg'; ?>">
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container container3">
    <div class="text">
      <h1>Product.</h1>
    </div>
    <!-- start product  -->
    <script type="importmap">
      {
        "imports": {
          "vue": "https://unpkg.com/vue@3/dist/vue.esm-browser.js"
        }
      }
    </script>
    <script type="module">
      import {
        createApp,
        ref,
        onMounted
      } from 'vue'

      function console_log(par) {
        if (window.location.origin == 'https://wpmock.test')
          console.log(par)
      }

      createApp({
        // data() {
        //   return {
        //     products: [],
        //     api: '<?php echo site_url(); ?>' + '/route/mockpress/v1/series',
        //   }
        // },
        // methods: {
        //   async fetchProducts() {
        //     try {
        //       let res = await fetch(this.api)
        //       res = await res.json()
        //       this.products = res
        //     } catch (err) {
        //       console_log(err)
        //     }


        //   }
        // },
        // async mounted() {

        //   await this.fetchProducts()
        //   console_log({
        //     api: this.api,
        //     products: this.products
        //   })
        // }

        setup() {
          const products = ref([])
          const api = '<?php echo MOCKPRESS_SERVER ?>' + '/route/mockpress/v1/series'

          const fetchProducts = async () => {
            try {
              let res

              res = await fetch(api)
              res = await res.json()
              products.value = res


            } catch (err) {
              console_log(err)
            }


          }

          onMounted(async () => {
            await fetchProducts()
            console_log({
              api: api,
              products: products.value
            })
          })

          return {
            products

          }
        }

      }).mount('#productscope')
    </script>


    <div id="productscope">

      <div v-if="products" class="row">
        <div v-for="product in products" class="col-md-6">
          <div class="card">
            <img :src="product.image">
            <div class="title">
              <h2>{{product.title}}</h2>
              <p>{{product.description}}</p>
              <a :href="product.button_url" target="_blank">
                <div class="btn">
                  {{product.button_text}}
                  <img src="<?php echo MOCKPRESS_URL . 'admin/assets/img/export.svg'; ?>">
                </div>
              </a>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- end product  -->
  </div>
</div>

<?php include_once 'register_license.php';
?>


<script type="text/javascript">
  jQuery(document).ready(function($) {
    // $('#c_home').hover(function() {
    //   $('#c_home').css('color', '#8276F8');
    //   $('#c_home path').css('fill', '#8276F8');
    // }, function() {
    //   $('#c_home').css('color', 'black');
    //   $('#c_home path').css('fill', 'black');
    // })

    // $('#c_license').hover(function() {
    //   $('#c_license').css('color', '#8276F8');
    //   $('#c_license path').css('fill', '#8276F8');
    // }, function() {
    //   $('#c_license').css('color', 'black');
    //   $('#c_license path').css('fill', 'black');
    // })


    $('#c_home').click((e) => {
      e.preventDefault();

      $('#c_home').css('color', '#8276F8');
      $('#c_home path').css('fill', '#8276F8');

      $('#c_license').css('color', 'black');
      $('#c_license path').css('fill', 'black');

      $('#license').hide();
      $('#home').show();

    })

    $('#c_license').click((e) => {
      e.preventDefault();

      $('#c_license path').css('fill', '#8276F8');
      $('#c_home path').css('fill', 'black');
      $('#c_license').css('color', '#8276F8');
      $('#c_home').css('color', 'black');

      $('#home').hide();
      $('#license').show();
    })
    let srv = '<?php echo MOCKPRESS_SERVER; ?>'
    let domain = location.hostname.replaceAll('.','_')

    console.log({srv,domain})
    fetch(`${srv}/route/lsd/v1/license/status/${domain}`)
    .then(res=>res.json())
    .then((res)=>{
      if (res.suspended) {
        $('#suspended-1').show()
        $('#suspended-2').show()

      }
    })

  });
  // jQuery(document).ready(function() {

  //   var hash = window.location.hash;
  //   if (hash) {
  //     jQuery("#navigation a").removeClass("active"); // removing active class from tab

  //     jQuery(".tab").hide(); // hiding open tab
  //     jQuery(hash).show(); // show tab
  //     jQuery(this).addClass("active"); //  adding active class to clicked tab
  //   } else {
  //     jQuery("#home").trigger("click");
  //   }

  //   jQuery("#navigation a").click(function(e) {
  //     e.preventDefault();
  //   });

  //   jQuery("#navigation a").click(function() {
  //     var tabid = jQuery(this).attr("href");
  //     jQuery("#navigation a").find("svg path").css({
  //       fill: '#29343E'
  //     });
  //     jQuery("#navigation a").removeClass("active"); // removing active class from tab

  //     jQuery(".tab").hide(); // hiding open tab
  //     jQuery(tabid).show(); // show tab
  //     jQuery(this).addClass("active"); //  adding active class to clicked tab
  //     jQuery(this).find("svg path").css({
  //       fill: '#7A6EF0'
  //     });
  //   });
  // });
</script>

<!-- Soon -->
<!-- <div class="container container4">
  <div class="row">
    <div class="col-md-7">
      <h2>Join Newsletter</h2>
      <p>Join as a Subcribers & get Special Offering from Us. We share many things about tips and tricks,
        Elementor Hack, Free templates and more</p>
      <div class="box-input">
        <input type="email" placeholder="Drop you E-mail">
        <button type="submit">Join</button>
      </div>
    </div>
    <div class="col-md-4">
      <img src="<?php echo MOCKPRESS_URL . 'admin/assets/img/ClipBoard.png'; ?>">
    </div>
  </div>
</div> -->