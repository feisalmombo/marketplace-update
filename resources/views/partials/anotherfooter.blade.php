<section class="w3l-market-footer">
    <footer class="footer-28">
      <div class="footer-bg-layer">
        <div class="container py-lg-3">
          <div class="row footer-top-28">
            <div class="col-md-6 footer-list-28 mt-5">
              <h1 class="footer-title-28"><strong style="color: #2B3483;">MarketPlace</strong><strong style="color: #E58225;">.</strong></h1>
            </div>
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-6 footer-list-28 mt-5">
                  <h6 class="footer-title-28">@lang('home.quick_links')</h6>
                  <ul>
                    <li><a href="#" style="pointer-events: none;">@lang('home.about_us')</a></li>
                    <li><a href="#" style="pointer-events: none;">@lang('home.bl_og')</a></li>
                    <li><a href="#" style="pointer-events: none;">@lang('home.cont_act')</a></li>
                    <li><a href="#" style="pointer-events: none;">@lang('home.faqs')</a></li>
                  </ul>
                </div>

                <div class="col-md-6 footer-list-28 mt-5">
                  <h6 class="footer-title-28">@lang('home.legal_stuff')</h6>
                  <ul>
                    <li><a href="#" style="pointer-events: none;">@lang('home.dis_claimer')</a></li>
                    <li><a href="#" style="pointer-events: none;">@lang('home.fina_ncing')</a></li>
                    <li><a href="#" style="pointer-events: none;">@lang('home.privacy_policy')</a></li>
                    @foreach($documentsDatas as $key => $documentsData)

                    @endforeach
                    <li><a href="{{ Storage::url($documentsData->file_path) }}" target="_blank">@lang('home.terms_and_conditions')</a></li>
                  </ul>
                </div>

              </div>
            </div>
          </div>
        </div>


        <div class="midd-footer-28 align-center py-lg-4 py-3 mt-5">
          <div class="container">
            <p class="copy-footer-28 text-center"> &copy; {{  date('Y') }} MarketPlace<strong style="color: yellow;">.</strong>@lang('home.all_rights_reserved') <a
                href="https://getpesa.co.tz/" target="_blank">GetPesa</a></p>
          </div>
        </div>
      </div>
    </footer>

    <!-- move top -->
    <button onclick="topFunction()" id="movetop" title="@lang('home.go_to_top')">
      &#10548;
    </button>

    <script>
      // When the user scrolls down 20px from the top of the document, show the button
      window.onscroll = function () {
        scrollFunction()
      };

      function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
          document.getElementById("movetop").style.display = "block";
        } else {
          document.getElementById("movetop").style.display = "none";
        }
      }

      // When the user clicks on the button, scroll to the top of the document
      function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
      }
    </script>

    <script type = "text/javascript">
        function getValue() {
           var retVal = prompt("Enter Language : ", "your name here");
           document.write("You have entered : " + retVal);
        }
  </script>

    <!-- /move top -->
  </section>
