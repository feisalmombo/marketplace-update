<section class="w3l-index-block6 py-5">
    <div class="container py-lg-3">
      <div class="subscribe mx-auto">
        <div class="heading text-center mx-auto">
          <h3 class="head">@lang('home.subscribe_our_newsletter')</h3>
          <p class="my-3 head">@lang('home.subscribe_with_your_email')</p>
        </div>

        <form action="{{ url('/subscriber-email') }}" method="POST" class="subscribe-wthree pt-2 mt-5">
          {{ csrf_field() }}

          <div class="d-flex flex-wrap subscribe-wthree-field">
            <input class="form-control" type="email" placeholder="@lang('home.enter_your_email')" name="email" id="email" required="required">
            <button class="btn form-control btn-primary" type="submit">@lang('home.sub_scribe')</button>
          </div>
        </form>
      </div>
    </div>
  </section>
