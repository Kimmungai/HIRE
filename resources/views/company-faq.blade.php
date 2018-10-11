@extends('layouts.hire_company')

@section('content')
<div class="hero">
    <h2>よくある質問</h2>
</div>
        <div class="media-container-row">
                <div class="toggle-content">
                    <h2 class="mbr-section-title pb-3 align-left mbr-fonts-style display-2">
                        よくある質問
                    </h2>

                    <div id="bootstrap-toggle" class="toggle-panel accordionStyles tab-content pt-5 mt-2">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <a role="button" class="collapsed panel-title text-black panel-heading" data-toggle="collapse" data-parent="#accordion" data-core="" href="#collapse2_472" aria-expanded="false" aria-controls="collapse2">
                                    <h4 class="mbr-fonts-style display-5">
                                        <span class="sign fa fa-arrow-down inactive"></span> Is it good for me?
                                    </h4>
                                </a>
                            </div>
                            <div id="collapse2_472" class="panel-body panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body p-4">
                                    <p class="mbr-fonts-style panel-text display-7">
                                       Mobirise is perfect for non-techies who are not familiar with the intricacies of web development and for designers who prefer to work as visually as possible, without fighting with code. Also great for pro-coders for fast prototyping and small customers' projects.</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <a role="button" class="collapsed panel-title text-black panel-heading" data-toggle="collapse" data-parent="#accordion" data-core="" href="#collapse3_472" aria-expanded="true" aria-controls="collapse3">
                                    <h4 class="mbr-fonts-style display-5">
                                        <span class="sign fa fa-arrow-down inactive"></span> Why Mobirise?
                                    </h4>
                                </a>
                            </div>
                            <div id="collapse3_472" class="panel-body panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body p-4">
                                    <p class="mbr-fonts-style panel-text display-7">
                                       Key differences from traditional builders:<br>* Minimalistic, extremely <strong>easy-to-use</strong> interface<br>* <strong>Mobile</strong>-friendliness, latest website blocks and techniques "out-the-box"<br>* <strong>Free</strong> for commercial and non-profit use</p>
                                </div>
                            </div>
                        </div>
                      </div>
              </div>
      </div>
  </div>
@endsection
