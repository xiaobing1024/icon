@extends('mobile.layouts.app')

@section('content')
    <div class="page" style="padding: 0 15px">
        <div class="page__bd page__bd_spacing">
            <div class="weui-cells">
                <div class="weui-cells__title" style="margin-top: .5em;margin-bottom: .5em">六个红球相等的历史开奖</div>
                @forelse ($data1 as $item)
                    <div class="weui-cell">
                        <div class="weui-cell__bd">
                            <div class="weui-flex" style="justify-content:space-between;align-items:baseline">
                                <p>{{ $item['no_name'] }}</p>
                                <p style="color:#999;font-size: 14px">{{ $item['day'] }}</p>
                            </div>
                            <div class="weui-flex" style="margin-top: 5px;">
                                <div style="{{ in_array($item['number_name'][0], $kw) && in_array($item['number_name'][1], $kw) ? 'border-bottom: 2px solid #f00;padding-bottom:2px': '' }}">
                                    <div class="ball">
                                        {{ $item['number_name'][0] }}
                                        <div style="{{ in_array($item['number_name'][0], $kw) ? 'border-bottom: 2px solid #f00;margin-top: 2px' : '' }}"></div>
                                    </div>
                                </div>

                                <div style="{{ in_array($item['number_name'][1], $kw) && in_array($item['number_name'][2], $kw) ? 'border-bottom: 2px solid #f00;padding-bottom:2px' : '' }}">
                                    <div class="ball">
                                        {{ $item['number_name'][1] }}
                                        <div style="{{ in_array($item['number_name'][1], $kw) ? 'border-bottom: 2px solid #f00;margin-top: 2px' : '' }}"></div>
                                    </div>
                                </div>

                                <div style="{{ in_array($item['number_name'][2], $kw) && in_array($item['number_name'][3], $kw) ? 'border-bottom: 2px solid #f00;padding-bottom:2px' : '' }}">
                                    <div class="ball">
                                        {{ $item['number_name'][2] }}
                                        <div style="{{ in_array($item['number_name'][2], $kw) ? 'border-bottom: 2px solid #f00;margin-top: 2px' : '' }}"></div>
                                    </div>
                                </div>
                                <div style="{{ in_array($item['number_name'][3], $kw) && in_array($item['number_name'][4], $kw) ? 'border-bottom: 2px solid #f00;padding-bottom:2px' : '' }}">
                                    <div class="ball">
                                        {{ $item['number_name'][3] }}
                                        <div style="{{ in_array($item['number_name'][3], $kw) ? 'border-bottom: 2px solid #f00;margin-top: 2px' : '' }}"></div>
                                    </div>
                                </div>
                                <div style="{{ in_array($item['number_name'][4], $kw) && in_array($item['number_name'][5], $kw) ? 'border-bottom: 2px solid #f00;padding-bottom:2px' : '' }}">
                                    <div class="ball">
                                        {{ $item['number_name'][4] }}
                                        <div style="{{ in_array($item['number_name'][4], $kw) ? 'border-bottom: 2px solid #f00;margin-top: 2px' : '' }}"></div>
                                    </div>
                                </div>
                                <div class="ball">
                                    {{ $item['number_name'][5] }}
                                    <div style="{{ in_array($item['number_name'][5], $kw) ? 'border-bottom: 2px solid #f00;margin-top: 2px' : '' }}"></div>
                                </div>
                                <div class="ball blue-ball">
                                    {{ $item['number_name'][6] }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="weui-cell">
                        <div class="weui-cell__bd">
                            无
                        </div>
                    </div>
                @endforelse
                <div class="weui-cells__title" style="margin-top: .5em;margin-bottom: .5em">五个红球相等的历史开奖</div>
                @forelse ($data2 as $item)
                    <div class="weui-cell">
                        <div class="weui-cell__bd">
                            <div class="weui-flex" style="justify-content:space-between;align-items:baseline">
                                <p>{{ $item['no_name'] }}</p>
                                <p style="color:#999;font-size: 14px">{{ $item['day'] }}</p>
                            </div>
                            <div class="weui-flex" style="margin-top: 5px;">
                                <div style="{{ in_array($item['number_name'][0], $kw) && in_array($item['number_name'][1], $kw) ? 'border-bottom: 2px solid #f00;padding-bottom:2px': '' }}">
                                    <div class="ball">
                                        {{ $item['number_name'][0] }}
                                        <div style="{{ in_array($item['number_name'][0], $kw) ? 'border-bottom: 2px solid #f00;margin-top: 2px' : '' }}"></div>
                                    </div>
                                </div>

                                <div style="{{ in_array($item['number_name'][1], $kw) && in_array($item['number_name'][2], $kw) ? 'border-bottom: 2px solid #f00;padding-bottom:2px' : '' }}">
                                    <div class="ball">
                                        {{ $item['number_name'][1] }}
                                        <div style="{{ in_array($item['number_name'][1], $kw) ? 'border-bottom: 2px solid #f00;margin-top: 2px' : '' }}"></div>
                                    </div>
                                </div>

                                <div style="{{ in_array($item['number_name'][2], $kw) && in_array($item['number_name'][3], $kw) ? 'border-bottom: 2px solid #f00;padding-bottom:2px' : '' }}">
                                    <div class="ball">
                                        {{ $item['number_name'][2] }}
                                        <div style="{{ in_array($item['number_name'][2], $kw) ? 'border-bottom: 2px solid #f00;margin-top: 2px' : '' }}"></div>
                                    </div>
                                </div>
                                <div style="{{ in_array($item['number_name'][3], $kw) && in_array($item['number_name'][4], $kw) ? 'border-bottom: 2px solid #f00;padding-bottom:2px' : '' }}">
                                    <div class="ball">
                                        {{ $item['number_name'][3] }}
                                        <div style="{{ in_array($item['number_name'][3], $kw) ? 'border-bottom: 2px solid #f00;margin-top: 2px' : '' }}"></div>
                                    </div>
                                </div>
                                <div style="{{ in_array($item['number_name'][4], $kw) && in_array($item['number_name'][5], $kw) ? 'border-bottom: 2px solid #f00;padding-bottom:2px' : '' }}">
                                    <div class="ball">
                                        {{ $item['number_name'][4] }}
                                        <div style="{{ in_array($item['number_name'][4], $kw) ? 'border-bottom: 2px solid #f00;margin-top: 2px' : '' }}"></div>
                                    </div>
                                </div>
                                <div class="ball">
                                    {{ $item['number_name'][5] }}
                                    <div style="{{ in_array($item['number_name'][5], $kw) ? 'border-bottom: 2px solid #f00;margin-top: 2px' : '' }}"></div>
                                </div>
                                <div class="ball blue-ball">
                                    {{ $item['number_name'][6] }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="weui-cell">
                        <div class="weui-cell__bd">
                            无
                        </div>
                    </div>
                @endforelse
                <div class="weui-cells__title" style="margin-top: .5em;margin-bottom: .5em">四个红球相等的历史开奖</div>
                @forelse ($data3 as $item)
                    <div class="weui-cell">
                        <div class="weui-cell__bd">
                            <div class="weui-flex" style="justify-content:space-between;align-items:baseline">
                                <p>{{ $item['no_name'] }}</p>
                                <p style="color:#999;font-size: 14px">{{ $item['day'] }}</p>
                            </div>
                            <div class="weui-flex" style="margin-top: 5px;">
                                <div style="{{ in_array($item['number_name'][0], $kw) && in_array($item['number_name'][1], $kw) ? 'border-bottom: 2px solid #f00;padding-bottom:2px': '' }}">
                                    <div class="ball">
                                        {{ $item['number_name'][0] }}
                                        <div style="{{ in_array($item['number_name'][0], $kw) ? 'border-bottom: 2px solid #f00;margin-top: 2px' : '' }}"></div>
                                    </div>
                                </div>

                                <div style="{{ in_array($item['number_name'][1], $kw) && in_array($item['number_name'][2], $kw) ? 'border-bottom: 2px solid #f00;padding-bottom:2px' : '' }}">
                                    <div class="ball">
                                        {{ $item['number_name'][1] }}
                                        <div style="{{ in_array($item['number_name'][1], $kw) ? 'border-bottom: 2px solid #f00;margin-top: 2px' : '' }}"></div>
                                    </div>
                                </div>

                                <div style="{{ in_array($item['number_name'][2], $kw) && in_array($item['number_name'][3], $kw) ? 'border-bottom: 2px solid #f00;padding-bottom:2px' : '' }}">
                                    <div class="ball">
                                        {{ $item['number_name'][2] }}
                                        <div style="{{ in_array($item['number_name'][2], $kw) ? 'border-bottom: 2px solid #f00;margin-top: 2px' : '' }}"></div>
                                    </div>
                                </div>
                                <div style="{{ in_array($item['number_name'][3], $kw) && in_array($item['number_name'][4], $kw) ? 'border-bottom: 2px solid #f00;padding-bottom:2px' : '' }}">
                                    <div class="ball">
                                        {{ $item['number_name'][3] }}
                                        <div style="{{ in_array($item['number_name'][3], $kw) ? 'border-bottom: 2px solid #f00;margin-top: 2px' : '' }}"></div>
                                    </div>
                                </div>
                                <div style="{{ in_array($item['number_name'][4], $kw) && in_array($item['number_name'][5], $kw) ? 'border-bottom: 2px solid #f00;padding-bottom:2px' : '' }}">
                                    <div class="ball">
                                        {{ $item['number_name'][4] }}
                                        <div style="{{ in_array($item['number_name'][4], $kw) ? 'border-bottom: 2px solid #f00;margin-top: 2px' : '' }}"></div>
                                    </div>
                                </div>
                                <div class="ball">
                                    {{ $item['number_name'][5] }}
                                    <div style="{{ in_array($item['number_name'][5], $kw) ? 'border-bottom: 2px solid #f00;margin-top: 2px' : '' }}"></div>
                                </div>
                                <div class="ball blue-ball">
                                    {{ $item['number_name'][6] }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="weui-cell">
                        <div class="weui-cell__bd">
                            无
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection