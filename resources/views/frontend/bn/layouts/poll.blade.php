<div class="greybg-area p-opinion-auto margin-top-20">
    <div class="section-hedding">
        <h2>জনমত জরিপ<span></span></h2>
    </div>
    @if($survey)
        <div id="survey-error-msg" class="errorSuccessStatus"><ul></ul></div>
        <div id="survey-success-msg" class="errorSuccessStatus"><ul></ul></div>
        <div class="people-opinion">
            <p>{{ $survey->title }}</p>
            <form id="myVoteForm">
                <input type="hidden" name="_token" id="survey-token" value="{{ csrf_token() }}">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="radio">
                            <label>
                                <input type="radio" class="myvote" name="vote" id="vote" value="1">&nbsp;হ্যাঁ &nbsp;
                            </label>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="radio">
                            <label>
                                <input type="radio" id="vote" class="myvote" value="2" name="vote">&nbsp;না&nbsp;
                            </label>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="radio">
                            <label>
                                <input type="radio" id="vote" class="myvote" value="3" name="vote" checked>&nbsp;মন্তব্য নেই
                            </label>
                        </div>
                    </li>
                </ul>
                <input type="button" id="btnSurvey" class="btn bdtimes-btn" value="ভোট দিন" >&nbsp;
                <a href="{{ url('old-survey-list') }}" class="old-result" href="">পুরোনো ফলাফল</a>
                <div id="survey-result">ভোট দিয়েছেন {{ $survey->ha + $survey->na + $survey->no_comment }} জন</div>
            </form>
        </div>
    @endif
</div>