<div class="greybg-area p-opinion-auto">
    <div class="section-hedding">
        <h2>Public Survey<span></span></h2>
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
                                <input type="radio" class="myvote" name="vote" id="vote" value="1" checked> Yes &nbsp;
                            </label>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="radio">
                            <label>
                                <input type="radio" id="vote" class="myvote" value="2" name="vote">&nbsp;No
                            </label>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="radio">
                            <label>
                                <input type="radio" id="vote" class="myvote" value="3" name="vote">&nbsp;No Comment
                            </label>
                        </div>
                    </li>
                </ul>
                <input type="button" id="btnSurvey" class="btn bdtimes-btn" value="Vote" >&nbsp;
                <a href="{{ url('en/old-survey-result') }}" class="old-result" href="">Old Result</a>
                <div id="survey-result">Total Vote: {{ $survey->ha + $survey->na + $survey->no_comment }}</div>
            </form>
        </div>
    @endif
</div>