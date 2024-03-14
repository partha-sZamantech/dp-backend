@if($polls)
    <div class="row">
        <div class="MultiCarousel" data-slide="1" id="MultiCarousel" data-interval="1000">
            <div class="MultiCarousel-inner">
                @foreach($polls as $poll)
                    @php
                        $yes_percentage         = round($poll->yes_vote > 0 ? ($poll->yes_vote * 100) / $poll->total_vote : 0);
                        $no_percentage          = round($poll->no_vote > 0 ? ($poll->no_vote * 100) / $poll->total_vote : 0) ;
                        $no_opinion_percentage  = round($poll->no_opinion > 0 ? ($poll->no_opinion * 100) / $poll->total_vote : 0);
                    @endphp
                    <div class="item">
                        <div class="panel">
                            <div class="panel-header">
                                <img class="img-responsive"
                                     src="{{ asset(config('appconfig.pollImagePath') . $poll->sm_image_path) }}">
                            </div>
                            <div class="panel-body">
                                <p class="poll-title">{{ $poll->poll_title }}</p>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="options" data-toggle="buttons">
                                            <label class="btn option option_{{ $poll->poll_id }} {{ $yes_percentage >= $no_percentage && $yes_percentage >= $no_opinion_percentage ? 'highest-voted' : null }}">
                                                <input class="opinion" type="radio" name="opinion{{ $poll->poll_id }}"
                                                       value="1">
                                                <i class="fa fa-circle-o"></i>
                                                <i class="fa fa-circle"></i>
                                                <span>  হ্যা</span>
                                                <span class="pull-right text-bold">  {{ $yes_percentage }}%</span>
                                            </label>
                                            <label class="btn option option_{{ $poll->poll_id }} {{ $no_percentage >= $yes_percentage && $no_percentage >= $no_opinion_percentage ? 'highest-voted' : null }}">
                                                <input class="opinion" type="radio" name="opinion{{ $poll->poll_id }}"
                                                       value="2">
                                                <i class="fa fa-circle-o"></i>
                                                <i class="fa fa-circle"></i>
                                                <span> না</span>
                                                <span class="pull-right text-bold">  {{ $no_percentage }}%</span>
                                            </label>
                                            <label class="btn option option_{{ $poll->poll_id }} {{ $no_opinion_percentage >= $yes_percentage && $no_opinion_percentage >= $no_percentage ? 'highest-voted' : null }}">
                                                <input class="opinion" type="radio" name="opinion{{ $poll->poll_id }}"
                                                       value="0">
                                                <i class="fa fa-circle-o"></i>
                                                <i class="fa fa-circle"></i>
                                                <span> মন্তব্য নেই</span>
                                                <span class="pull-right text-bold">  {{ $no_opinion_percentage }}%</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button class="btn btn-primary btn_vote d-none" id="btnChange{{ $poll->poll_id }}" onclick="change_vote({{ $poll->poll_id }})">ভোট পরিবর্তন</button>
                                <button class="btn btn-primary btn_vote" id="btnVote{{ $poll->poll_id }}"
                                        onclick="submit_vote({{ $poll->poll_id }})">ভোট দিন
                                </button>
                                <a class="btn btn_vote_share marginTop5" id="btnShare" href="//www.facebook.com/sharer.php?u=https://www.dhakaprokash24.com/poll" target="_blank">
                                    <i class="fa fa-facebook-square" style="margin-right: 8px;"></i>শেয়ার করুন
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="btn btn-primary leftLst">
                <i class="fa fa-arrow-left"></i>
            </button>
            <button class="btn btn-primary rightLst">
                <i class="fa fa-arrow-right"></i>
            </button>
        </div>
    </div>
@endif
