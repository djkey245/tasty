@extends('layout.main')
@section('content')


    <main class="cas">
        <div class="main__container">

            <div class="cas__slider">

                <div class="cas__slider_header">
                    <a href="/" class="cas__slider_header_back"><p>{{trans("blocks/cases.back")}}</p></a>

                    <h1 class="ttl48">{{$case->title}}</h1>

                    <!-- <div class="cas__slider_header_pag">

                        <div class="cas__slider_header_pag_cont">
                            <input type="radio" name="cases_pag" id="cases_pag_1" checked>
                            <label for="cases_pag_1">1</label>

                            <input type="radio" name="cases_pag" id="cases_pag_2">
                            <label for="cases_pag_2">2</label>

                            <input type="radio" name="cases_pag" id="cases_pag_3">
                            <label for="cases_pag_3">3</label>

                            <input type="radio" name="cases_pag" id="cases_pag_4">
                            <label for="cases_pag_4">4</label>

                            <input type="radio" name="cases_pag" id="cases_pag_5">
                            <label for="cases_pag_5">5</label>
                        </div>

                        <p>Steam bots: <span>Online</span></p>
                    </div> -->
                </div>

                <style>
                    .cas-slider {
                        height: 310px;
                        width: 100%;
                        position: relative;
                        overflow: hidden;
                        margin-top: 50px;
                        padding: 14px 0;
                    }

                    .cas-slider .cas__slider_main {
                        -webkit-box-orient: horizontal;
                        -webkit-box-direction: normal;
                        -webkit-flex-direction: row;
                        width: max-content;
                        display: flex;
                        flex-direction: row;
                        overflow: hidden;
                        margin-left: -260px;
                        margin-top: 0;
                        padding-left: 0;
                        background: #241F4A;
                        /*background: yellow;*/
                        padding-top: 19px;
                        height: 100%;
                    }

                    .cas-slider .cas__slider_main .cas__slider_main_cont {
                        height: 100%;
                        box-sizing: border-box;
                        width: 196px;
                        margin: 0 7px;
                    }

                    .cas-slider .cas__slider_main .cas__slider_main_cont .cas__slider_main_block {
                        margin: 0;
                        width: 100%;
                        display: flex;
                        height: 100%;

                        /*justify-content: center;*/
                    }

                    .cas-slider .cas__slider_main .cas__slider_main_cont .cas__slider_main_block p {
                        align-self: flex-end;
                        text-align: center;
                        width: 80%;
                        padding-bottom: 5px;
                        position: relative;
                    }

                    .cas-slider .cas__slider_main .cas__slider_main_cont .gun {
                        width: 90%;
                        top: 20px;
                    }

                    .cas-slider .cas__slider_main .cas__slider_main_cont .item {
                        top: 25px;
                    }
                </style>
                <div class="cas__slider_01" style="">
                    <div class="cas-slider">
                        <div class="cas__slider_main" style="">

                            @foreach($feed as $drop)
                                <div class="cas__slider_main_cont" style="">
                                    <div class="cas__slider_main_block {{$drop->color}}">
                                        <img class="gun" src="{{$drop->img}}" alt="gun tasty-case">
                                        <img class="item" src="/img/item01.svg" alt="gun tasty-case">
                                        @include('layout.skin-block.name', ['name' => $drop->translatedTitle])
                                    </div>
                                </div>
                            @endforeach


                        </div>
                        <img class="cas__slider_main_frame01" style="bottom: calc(100% - 22px);"
                             src="/img/cases_frame01.png" alt="gun tasty-case">
                        <img class="cas__slider_main_frame02" style="top: calc(100% - 22px);"
                             src="/img/cases_frame02.png" alt="gun tasty-case">

                    </div>
                    <div class="cas__slider_settings">
                        <label class="cas__slider_settings_chkbox">
                            <input type="checkbox" id="mutesounds" name="">
                            <div></div>
                            <p>{{trans("blocks/cases.soundOn")}}</p>
                        </label>

                        {{--<div class="cas__slider_settings_cont">

                            <label for="">
                                <input type="radio" name="cas__slider_mult" id="" checked>
                                <div>x1</div>
                            </label>
                            <label for="">
                                <input type="radio" name="cas__slider_mult" id="">
                                <div>x2</div>
                            </label>
                            <label for="">
                                <input type="radio" name="cas__slider_mult" id="">
                                <div>x3</div>
                            </label>
                            <label for="">
                                <input type="radio" name="cas__slider_mult" id="">
                                <div>x4</div>
                            </label>
                            <label for="">
                                <input type="radio" name="cas__slider_mult" id="">
                                <div>x5</div>
                            </label>
                            <label for="">
                                <input type="radio" name="cas__slider_mult" id="">
                                <div>x6</div>
                            </label>
                            <label for="">
                                <input type="radio" name="cas__slider_mult" id="">
                                <div>x7</div>
                            </label>
                            <label for="">
                                <input type="radio" name="cas__slider_mult" id="">
                                <div>x8</div>
                            </label>
                            <label for="">
                                <input type="radio" name="cas__slider_mult" id="">
                                <div>9</div>
                            </label>
                            <label for="">
                                <input type="radio" name="cas__slider_mult" id="">
                                <div>x10</div>
                            </label>

                        </div>--}}

                        <label class="cas__slider_settings_chkbox">
                            <input type="checkbox" id="fastopen" name="">
                            <div></div>
                            <p>{{trans("blocks/cases.fast_open")}}</p>
                        </label>
                    </div>
                    <div class="cas__slider_bottom">
                        <p>{{trans('project_defs.currency_sign')}}<span>{{$case->modified_price}}</span></p>
                        <button onclick="openCase()">{{trans("blocks/cases.open_case")}}</button>
                    </div>
                </div>

            </div>

            @include('layout.cases.top-case-opens')

            <div class="cas__cases">
                <h3 class="ttl35">{{trans('blocks/cases.content_in_case')}} {{$randomSmile}}</h3>

                <div class="skins__cont">
                    @foreach($items as $item)
                        @include('layout.skin-block.skin-block',
                                    [
                                        'status' => 'disabled',
                                        'item' => $item
                                    ]
                                )
                    @endforeach


                </div>
            </div>
            @isset($recommendCategory)
                @include('layout.cases.recommend-cases', ['lotcases' => $recommendCategory->activeLotcases, 'title' => trans('blocks/cases.recommend_title') ])
            @endisset
        </div>
    </main>




@endsection

@section('scripts')
    <script>
        (function (t, e) {
            if (typeof define === "function" && define.amd) {
                define(["jquery"], e)
            } else if (typeof exports === "object") {
                module.exports = e(require("jquery"))
            } else {
                e(t.jQuery)
            }
        })(this, function (t) {
            t.transit = {
                version: "0.9.12",
                propertyMap: {
                    marginLeft: "margin",
                    marginRight: "margin",
                    marginBottom: "margin",
                    marginTop: "margin",
                    paddingLeft: "padding",
                    paddingRight: "padding",
                    paddingBottom: "padding",
                    paddingTop: "padding"
                },
                enabled: true,
                useTransitionEnd: false
            };
            var e = document.createElement("div");
            var n = {};

            function i(t) {
                if (t in e.style) return t;
                var n = ["Moz", "Webkit", "O", "ms"];
                var i = t.charAt(0).toUpperCase() + t.substr(1);
                for (var r = 0; r < n.length; ++r) {
                    var s = n[r] + i;
                    if (s in e.style) {
                        return s
                    }
                }
            }

            function r() {
                e.style[n.transform] = "";
                e.style[n.transform] = "rotateY(90deg)";
                return e.style[n.transform] !== ""
            }

            var s = navigator.userAgent.toLowerCase().indexOf("chrome") > -1;
            n.transition = i("transition");
            n.transitionDelay = i("transitionDelay");
            n.transform = i("transform");
            n.transformOrigin = i("transformOrigin");
            n.filter = i("Filter");
            n.transform3d = r();
            var a = {
                transition: "transitionend",
                MozTransition: "transitionend",
                OTransition: "oTransitionEnd",
                WebkitTransition: "webkitTransitionEnd",
                msTransition: "MSTransitionEnd"
            };
            var o = n.transitionEnd = a[n.transition] || null;
            for (var u in n) {
                if (n.hasOwnProperty(u) && typeof t.support[u] === "undefined") {
                    t.support[u] = n[u]
                }
            }
            e = null;
            t.cssEase = {
                _default: "ease",
                "in": "ease-in",
                out: "ease-out",
                "in-out": "ease-in-out",
                snap: "cubic-bezier(0,1,.5,1)",
                easeInCubic: "cubic-bezier(.550,.055,.675,.190)",
                easeOutCubic: "cubic-bezier(.215,.61,.355,1)",
                easeInOutCubic: "cubic-bezier(.645,.045,.355,1)",
                easeInCirc: "cubic-bezier(.6,.04,.98,.335)",
                easeOutCirc: "cubic-bezier(.075,.82,.165,1)",
                easeInOutCirc: "cubic-bezier(.785,.135,.15,.86)",
                easeInExpo: "cubic-bezier(.95,.05,.795,.035)",
                easeOutExpo: "cubic-bezier(.19,1,.22,1)",
                easeInOutExpo: "cubic-bezier(1,0,0,1)",
                easeInQuad: "cubic-bezier(.55,.085,.68,.53)",
                easeOutQuad: "cubic-bezier(.25,.46,.45,.94)",
                easeInOutQuad: "cubic-bezier(.455,.03,.515,.955)",
                easeInQuart: "cubic-bezier(.895,.03,.685,.22)",
                easeOutQuart: "cubic-bezier(.165,.84,.44,1)",
                easeInOutQuart: "cubic-bezier(.77,0,.175,1)",
                easeInQuint: "cubic-bezier(.755,.05,.855,.06)",
                easeOutQuint: "cubic-bezier(.23,1,.32,1)",
                easeInOutQuint: "cubic-bezier(.86,0,.07,1)",
                easeInSine: "cubic-bezier(.47,0,.745,.715)",
                easeOutSine: "cubic-bezier(.39,.575,.565,1)",
                easeInOutSine: "cubic-bezier(.445,.05,.55,.95)",
                easeInBack: "cubic-bezier(.6,-.28,.735,.045)",
                easeOutBack: "cubic-bezier(.175, .885,.32,1.275)",
                easeInOutBack: "cubic-bezier(.68,-.55,.265,1.55)"
            };
            t.cssHooks["transit:transform"] = {
                get: function (e) {
                    return t(e).data("transform") || new f
                }, set: function (e, i) {
                    var r = i;
                    if (!(r instanceof f)) {
                        r = new f(r)
                    }
                    if (n.transform === "WebkitTransform" && !s) {
                        e.style[n.transform] = r.toString(true)
                    } else {
                        e.style[n.transform] = r.toString()
                    }
                    t(e).data("transform", r)
                }
            };
            t.cssHooks.transform = {set: t.cssHooks["transit:transform"].set};
            t.cssHooks.filter = {
                get: function (t) {
                    return t.style[n.filter]
                }, set: function (t, e) {
                    t.style[n.filter] = e
                }
            };
            if (t.fn.jquery < "1.8") {
                t.cssHooks.transformOrigin = {
                    get: function (t) {
                        return t.style[n.transformOrigin]
                    }, set: function (t, e) {
                        t.style[n.transformOrigin] = e
                    }
                };
                t.cssHooks.transition = {
                    get: function (t) {
                        return t.style[n.transition]
                    }, set: function (t, e) {
                        t.style[n.transition] = e
                    }
                }
            }
            p("scale");
            p("scaleX");
            p("scaleY");
            p("translate");
            p("rotate");
            p("rotateX");
            p("rotateY");
            p("rotate3d");
            p("perspective");
            p("skewX");
            p("skewY");
            p("x", true);
            p("y", true);

            function f(t) {
                if (typeof t === "string") {
                    this.parse(t)
                }
                return this
            }

            f.prototype = {
                setFromString: function (t, e) {
                    var n = typeof e === "string" ? e.split(",") : e.constructor === Array ? e : [e];
                    n.unshift(t);
                    f.prototype.set.apply(this, n)
                }, set: function (t) {
                    var e = Array.prototype.slice.apply(arguments, [1]);
                    if (this.setter[t]) {
                        this.setter[t].apply(this, e)
                    } else {
                        this[t] = e.join(",")
                    }
                }, get: function (t) {
                    if (this.getter[t]) {
                        return this.getter[t].apply(this)
                    } else {
                        return this[t] || 0
                    }
                }, setter: {
                    rotate: function (t) {
                        this.rotate = b(t, "deg")
                    }, rotateX: function (t) {
                        this.rotateX = b(t, "deg")
                    }, rotateY: function (t) {
                        this.rotateY = b(t, "deg")
                    }, scale: function (t, e) {
                        if (e === undefined) {
                            e = t
                        }
                        this.scale = t + "," + e
                    }, skewX: function (t) {
                        this.skewX = b(t, "deg")
                    }, skewY: function (t) {
                        this.skewY = b(t, "deg")
                    }, perspective: function (t) {
                        this.perspective = b(t, "px")
                    }, x: function (t) {
                        this.set("translate", t, null)
                    }, y: function (t) {
                        this.set("translate", null, t)
                    }, translate: function (t, e) {
                        if (this._translateX === undefined) {
                            this._translateX = 0
                        }
                        if (this._translateY === undefined) {
                            this._translateY = 0
                        }
                        if (t !== null && t !== undefined) {
                            this._translateX = b(t, "px")
                        }
                        if (e !== null && e !== undefined) {
                            this._translateY = b(e, "px")
                        }
                        this.translate = this._translateX + "," + this._translateY
                    }
                }, getter: {
                    x: function () {
                        return this._translateX || 0
                    }, y: function () {
                        return this._translateY || 0
                    }, scale: function () {
                        var t = (this.scale || "1,1").split(",");
                        if (t[0]) {
                            t[0] = parseFloat(t[0])
                        }
                        if (t[1]) {
                            t[1] = parseFloat(t[1])
                        }
                        return t[0] === t[1] ? t[0] : t
                    }, rotate3d: function () {
                        var t = (this.rotate3d || "0,0,0,0deg").split(",");
                        for (var e = 0; e <= 3; ++e) {
                            if (t[e]) {
                                t[e] = parseFloat(t[e])
                            }
                        }
                        if (t[3]) {
                            t[3] = b(t[3], "deg")
                        }
                        return t
                    }
                }, parse: function (t) {
                    var e = this;
                    t.replace(/([a-zA-Z0-9]+)\((.*?)\)/g, function (t, n, i) {
                        e.setFromString(n, i)
                    })
                }, toString: function (t) {
                    var e = [];
                    for (var i in this) {
                        if (this.hasOwnProperty(i)) {
                            if (!n.transform3d && (i === "rotateX" || i === "rotateY" || i === "perspective" || i === "transformOrigin")) {
                                continue
                            }
                            if (i[0] !== "_") {
                                if (t && i === "scale") {
                                    e.push(i + "3d(" + this[i] + ",1)")
                                } else if (t && i === "translate") {
                                    e.push(i + "3d(" + this[i] + ",0)")
                                } else {
                                    e.push(i + "(" + this[i] + ")")
                                }
                            }
                        }
                    }
                    return e.join(" ")
                }
            };

            function c(t, e, n) {
                if (e === true) {
                    t.queue(n)
                } else if (e) {
                    t.queue(e, n)
                } else {
                    t.each(function () {
                        n.call(this)
                    })
                }
            }

            function l(e) {
                var i = [];
                t.each(e, function (e) {
                    e = t.camelCase(e);
                    e = t.transit.propertyMap[e] || t.cssProps[e] || e;
                    e = h(e);
                    if (n[e]) e = h(n[e]);
                    if (t.inArray(e, i) === -1) {
                        i.push(e)
                    }
                });
                return i
            }

            function d(e, n, i, r) {
                var s = l(e);
                if (t.cssEase[i]) {
                    i = t.cssEase[i]
                }
                var a = "" + y(n) + " " + i;
                if (parseInt(r, 10) > 0) {
                    a += " " + y(r)
                }
                var o = [];
                t.each(s, function (t, e) {
                    o.push(e + " " + a)
                });
                return o.join(", ")
            }

            t.fn.transition = t.fn.transit = function (e, i, r, s) {
                var a = this;
                var u = 0;
                var f = true;
                var l = t.extend(true, {}, e);
                if (typeof i === "function") {
                    s = i;
                    i = undefined
                }
                if (typeof i === "object") {
                    r = i.easing;
                    u = i.delay || 0;
                    f = typeof i.queue === "undefined" ? true : i.queue;
                    s = i.complete;
                    i = i.duration
                }
                if (typeof r === "function") {
                    s = r;
                    r = undefined
                }
                if (typeof l.easing !== "undefined") {
                    r = l.easing;
                    delete l.easing
                }
                if (typeof l.duration !== "undefined") {
                    i = l.duration;
                    delete l.duration
                }
                if (typeof l.complete !== "undefined") {
                    s = l.complete;
                    delete l.complete
                }
                if (typeof l.queue !== "undefined") {
                    f = l.queue;
                    delete l.queue
                }
                if (typeof l.delay !== "undefined") {
                    u = l.delay;
                    delete l.delay
                }
                if (typeof i === "undefined") {
                    i = t.fx.speeds._default
                }
                if (typeof r === "undefined") {
                    r = t.cssEase._default
                }
                i = y(i);
                var p = d(l, i, r, u);
                var h = t.transit.enabled && n.transition;
                var b = h ? parseInt(i, 10) + parseInt(u, 10) : 0;
                if (b === 0) {
                    var g = function (t) {
                        a.css(l);
                        if (s) {
                            s.apply(a)
                        }
                        if (t) {
                            t()
                        }
                    };
                    c(a, f, g);
                    return a
                }
                var m = {};
                var v = function (e) {
                    var i = false;
                    var r = function () {
                        if (i) {
                            a.unbind(o, r)
                        }
                        if (b > 0) {
                            a.each(function () {
                                this.style[n.transition] = m[this] || null
                            })
                        }
                        if (typeof s === "function") {
                            s.apply(a)
                        }
                        if (typeof e === "function") {
                            e()
                        }
                    };
                    if (b > 0 && o && t.transit.useTransitionEnd) {
                        i = true;
                        a.bind(o, r)
                    } else {
                        window.setTimeout(r, b)
                    }
                    a.each(function () {
                        if (b > 0) {
                            this.style[n.transition] = p
                        }
                        t(this).css(l)
                    })
                };
                var z = function (t) {
                    this.offsetWidth;
                    v(t)
                };
                c(a, f, z);
                return this
            };

            function p(e, i) {
                if (!i) {
                    t.cssNumber[e] = true
                }
                t.transit.propertyMap[e] = n.transform;
                t.cssHooks[e] = {
                    get: function (n) {
                        var i = t(n).css("transit:transform");
                        return i.get(e)
                    }, set: function (n, i) {
                        var r = t(n).css("transit:transform");
                        r.setFromString(e, i);
                        t(n).css({"transit:transform": r})
                    }
                }
            }

            function h(t) {
                return t.replace(/([A-Z])/g, function (t) {
                    return "-" + t.toLowerCase()
                })
            }

            function b(t, e) {
                if (typeof t === "string" && !t.match(/^[\-0-9\.]+$/)) {
                    return t
                } else {
                    return "" + t + e
                }
            }

            function y(e) {
                var n = e;
                if (typeof n === "string" && !n.match(/^[\-0-9\.]+/)) {
                    n = t.fx.speeds[n] || t.fx.speeds._default
                }
                return b(n, "ms")
            }

            t.transit.getTransitionValue = d;
            return t
        });
        jQuery.extend({
            bez: function (encodedFuncName, coOrdArray) {
                if (jQuery.isArray(encodedFuncName)) {
                    coOrdArray = encodedFuncName;
                    encodedFuncName = "bez_" + coOrdArray.join("_").replace(/\./g, "p")
                }
                if (typeof jQuery.easing[encodedFuncName] !== "function") {
                    var polyBez = function (p1, p2) {
                        var A = [null, null], B = [null, null], C = [null, null], bezCoOrd = function (t, ax) {
                            C[ax] = 3 * p1[ax], B[ax] = 3 * (p2[ax] - p1[ax]) - C[ax], A[ax] = 1 - C[ax] - B[ax];
                            return t * (C[ax] + t * (B[ax] + t * A[ax]))
                        }, xDeriv = function (t) {
                            return C[0] + t * (2 * B[0] + 3 * A[0] * t)
                        }, xForT = function (t) {
                            var x = t, i = 0, z;
                            while (++i < 14) {
                                z = bezCoOrd(x, 0) - t;
                                if (Math.abs(z) < .001) break;
                                x -= z / xDeriv(x)
                            }
                            return x
                        };
                        return function (t) {
                            return bezCoOrd(xForT(t), 1)
                        }
                    };
                    jQuery.easing[encodedFuncName] = function (x, t, b, c, d) {
                        return c * polyBez([coOrdArray[0], coOrdArray[1]], [coOrdArray[2], coOrdArray[3]])(t / d) + b
                    }
                }
                return encodedFuncName
            }
        });

        (function ($) {

            $.fn.shuffle = function () {

                var allElems = this.get(),
                    getRandom = function (max) {
                        return Math.floor(Math.random() * max);
                    },
                    shuffled = $.map(allElems, function () {
                        var random = getRandom(allElems.length),
                            randEl = $(allElems[random]).clone(true)[0];
                        allElems.splice(random, 1);
                        return randEl;
                    });

                this.each(function (i) {
                    $(this).replaceWith($(shuffled[i]));
                });

                return $(shuffled);

            };

        })(jQuery);
    </script>
    <script>

        masterVolume = 0.25;
        fastOpen = 11500;
        // All the case sounds
        let case_start = new Audio("/sounds/csgo_ui_crate_open.wav");
        case_start.volume = masterVolume * 0.25;
        let clicks = [];

        for (let i = 0; i < 20; i++) {
            clicks[i] = new Audio("/sounds/csgo_ui_crate_item_scroll.wav");
            clicks[i].volume = masterVolume * 0.2;
        }

        let clicknum = 0;

        let case_done = {};

        case_done.common = new Audio("/sounds/item_drop1_common.wav");
        case_done.common.volume = masterVolume * 0.3;
        case_done.uncommon = new Audio("/sounds/item_drop2_uncommon.wav");
        case_done.uncommon.volume = masterVolume * 0.3;
        case_done.rare = new Audio("/sounds/item_drop3_rare.wav");
        case_done.rare.volume = masterVolume * 0.3;
        case_done.mythical = new Audio("/sounds/item_drop4_mythical.wav");
        case_done.mythical.volume = masterVolume * 0.3;
        case_done.legendary = new Audio("/sounds/item_drop5_legendary.wav");
        case_done.legendary.volume = masterVolume * 0.4;
        case_done.immortal = new Audio("/sounds/item_drop6_ancient.wav");
        case_done.immortal.volume = masterVolume * 0.45;
        case_done.ancient = new Audio("/sounds/item_drop6_ancient.wav");
        case_done.ancient.volume = masterVolume * 0.45;
        case_done.arcana = new Audio("/sounds/item_drop6_ancient.wav");
        case_done.arcana.volume = masterVolume * 0.45;
        let canPlayClick = true;
        let clickInterval = 0;

        // Timing of the clicks; this function makes it so a click plays a maximum of once every 0.2 seconds.
        // If a click is already playing, and this function is called, it queues the click to play after the current one is done.
        // Only one click can be queued, if one is already queued, the function does nothing.

        function playClick() {
            if (canPlayClick) {
                canPlayClick = false;
                clicks[clicknum++ % 20].play();
                setTimeout(function () {
                    canPlayClick = true;
                }, 100)
            } else {
                if (clickInterval == 0) {
                    clickInterval = setInterval(function () {
                        if (canPlayClick) {
                            setTimeout(function () {
                                canPlayClick = true;
                            }, 100)
                            clicks[clicknum++ % 20].play();
                            clearInterval(clickInterval);
                            clickInterval = 0;
                            canPlayClick = false;
                        }
                    }, 5);
                }
            }
        }

        $("#mutesounds").click(function () {
            masterVolume = (!$(this).is(":checked")) * 0.2;
            changeSoundText(!!masterVolume);
            case_start.volume = masterVolume * 0.25;
            case_done.common.volume = masterVolume * 0.3;
            case_done.uncommon.volume = masterVolume * 0.3;
            case_done.rare.volume = masterVolume * 0.3;
            case_done.mythical.volume = masterVolume * 0.3;
            case_done.legendary.volume = masterVolume * 0.4;
            case_done.immortal.volume = masterVolume * 0.45;
            case_done.ancient.volume = masterVolume * 0.45;
            case_done.arcana.volume = masterVolume * 0.45;
            for (let i = 0; i < 20; i++) {
                clicks[i].volume = masterVolume * 0.2;
            }
        })
        $("#fastopen").click(function () {
            fastOpen = (!$(this).is(":checked")) * 11500;
        })

        function changeSoundText(isOn) {
            console.log(document.querySelector("#mutesounds ~ p"));
            document.querySelector("#mutesounds ~ p").innerText = isOn ?
                "{{trans("blocks/cases.soundOn")}}" :
                "{{trans("blocks/cases.soundOff")}}";
        }

    </script>
    @auth
        <script>

            var transit = 4000;

            /*
                        $("label.roulette--energy").on('click', function () {

                            if ($(this).find("input:checkbox").is(':checked')) {
                                var group = "input:checkbox[name='stattrak']";
                                $(group).prop('checked', false);
                                $('.fa.fa-bolt').removeClass("selected_boost");
                            } else {
                                var group = "input:checkbox[name='stattrak']";
                                $(group).prop('checked', false);
                                $('.fa.fa-bolt').removeClass("selected_boost");
                                $(this).find("input:checkbox").prop('checked', true);
                                $(this).find('.roulette--energy-in i').addClass("selected_boost");
                            }
                        });
            */
            function openCase2() {
                console.log(1)
                $.ajax({
                    type: "POST",
                    url: "/cases/" + "3",
                    // url: window.location.pathname,
                    data: {'case': "3", 'boost': 1, 'fastOpen': false, locale: '{{app()->getLocale()}}'},
                });
            }

            function openCase() {

                $('.cas__slider_bottom button').attr('disabled', 'disabled');
                var boost = 0;
                if ($("input:checkbox[name='stattrak']:checked").val() !== undefined) {
                    boost = $("input:checkbox[name='stattrak']:checked").val();
                }

                $.ajax({
                    type: "POST",
                    url: "/cases/" + "{{$case->id}}",
                    // url: window.location.pathname,
                    data: {
                        'case': "{{$case->id}}",
                        'boost': boost,
                        'fastOpen': fastOpen,
                        locale: '{{app()->getLocale()}}'
                    },
                    success: function (resp) {
                        // console.log(resp);
                        if (resp.error) {
                            // $('#case_modal').niftyModal();
                            $('.cas__slider_bottom button').removeAttr('disabled');
                            return toastr.error(resp.error);
                        }
                        if (resp.success) {

                            /*
                                                        ga('ecommerce:addTransaction', {
                                                            'id': resp.user_drop.id,                     // Transaction ID. Required.
                                                            'affiliation': resp.success.lotcase_id,   // Affiliation or store name.
                                                            'revenue': resp.price,               // Grand Total.
                                                            'shipping': '0',                  // Shipping.
                                                            'tax': '0',                     // Tax.
                                                            'currency': 'RUB'
                                                        });
                                                        ga('ecommerce:send');
                                                        setTimeout(function () {
                                                            ga('ecommerce:clear');
                                                        }, 1500);
                            */
                            $('.header__top_account_balance span').html(resp.balance);
                            $('.header__top_account_health span').html(resp.hearts.toFixed(2));
                            $('.header__top_account_rank').attr('src', '/storage/' + resp.rank.rank_img);
                            $('.header__top_account_rank').attr('alt', resp.rank.rank);

                            $(".cas__slider_main .cas__slider_main_cont").shuffle();
                            $('.cas__slider_main')
                                .transition({x: 0 + 'px'}, 0);

                            case_start.play();


                            if (resp.success.title.indexOf('|') !== -1) {
                                $($('div.cas__slider_main_cont')[155]).html(
                                    '                                    <div class="cas__slider_main_block ' + resp.success.color + '">\n' +
                                    '                                        <img class="gun" src="' + resp.success.img + '" alt="gun tasty-case">\n' +
                                    '                                        <img class="item" src="/img/item01.svg" alt="gun tasty-case">\n' +
                                    '                                        <p class="ttl16"> ' + resp.success.title.substring(0, resp.success.title.indexOf('|')) + '' +
                                    '                                           <span>' + resp.success.title.substring((resp.success.title.indexOf('|') + 1)) + '</span>' +
                                    '                                        </p>\n' +
                                    '                                    </div>\n'
                                );
                            } else {
                                $($('div.cas__slider_main_cont')[155]).html(
                                    '                                    <div class="cas__slider_main_block ' + resp.success.color + '">\n' +
                                    '                                        <img class="gun" src="' + resp.success.img + '" alt="gun tasty-case">\n' +
                                    '                                        <img class="item" src="/img/item01.svg" alt="gun tasty-case">\n' +
                                    '                                        <p class="ttl16"> <span>' + resp.success.title + '</span></p>\n' +
                                    '                                    </div>\n'
                                );
                            }

                            let item_width = $($('div.cas__slider_main_cont')[155]).width();

                            let random = Math.random();
                            let markerOffset = $(".cas-slider").width() / 2 + 280 + 105;

                            let start_win_position = (155 * (item_width + 14)) - 260 - ($(".cas-slider").width() / 2);
                            var leftPosition = start_win_position + Math.floor(random * ((item_width + 8) - 7)) + 8;
                            console.log(leftPosition, random);
                            // get the offset of the marker for where a case lands on

                            // let item_width = $($('.r.item')[155]).width();
                            let last = 0; // last position a click was played at
                            $({tracker: 500}).animate({tracker: leftPosition}, {
                                duration: fastOpen, easing: $.bez([.31, .9985, .31, .9985]),
                                step: function (now) { // called every frame
                                    if (last < Math.floor((now - markerOffset - 70) / item_width)) {
                                        playClick();
                                        last = Math.floor((now - markerOffset - 70) / item_width);
                                    }
                                }
                            });

                            $('div.cas__slider_main')
                                .transition({x: '-' + leftPosition + 'px'}, fastOpen, 'cubic-bezier(.31,.9985,.31,.9985)', function () {
                                    rarity = resp.success.sound.toLowerCase();
                                    case_done[rarity].play();
                                    $("#sale-item span").html(resp.success.modified_price + '{{trans('project_defs.currency_sign')}}');
                                    $("#sale-item").attr('onclick', 'saleItem(' + resp.user_drop.id + ')');
                                    $("#win_field_auth").removeAttr('class');
                                    $("#win_field_auth").addClass('skinblock ' + resp.success.color);
                                    if (resp.success.title.indexOf('|') !== -1) {

                                        $("#win_field_auth").html(
                                            '            <img class="gun" src="' + resp.success.img + '" alt="gun tasty-case">\n' +
                                            '            <img class="item" src="/img/item02.svg" alt="gun tasty-case">\n' +
                                            '            <p class="ttl"> <span>' + resp.success.title.substring(0, resp.success.title.indexOf('|')) + '</span>' +
                                            '                ' + resp.success.title.substring((resp.success.title.indexOf('|') + 1)) + '' +
                                            '            </p>\n'
                                        );
                                    } else {
                                        $("#win_field_auth").html(
                                            '            <img class="gun" src="' + resp.success.img + '" alt="gun tasty-case">\n' +
                                            '            <img class="item" src="/img/item02.svg" alt="gun tasty-case">\n' +
                                            '            <p class="ttl"> <span>' + resp.success.title + '</span></p>\n'
                                        );

                                    }
                                    $("#cases-popup").fadeIn(300);

                                    $("body").addClass("blur");


                                    $('.cas__slider_bottom button').removeAttr('disabled');
                                }).removeClass('caseopening');


                        }

                        console.log(resp);
                    },
                    error: function (err) {
                        if (err.responseJSON.message) {
                            toastr.error(err.responseJSON.message)
                        } else {
                            toastr.error("Error")
                        }
                    }
                });

            }

            function saleItem(user_drop_id) {
                $.ajax({
                    type: "POST",
                    url: '/sale-item',
                    data: {'user_item': user_drop_id, locale: '{{app()->getLocale()}}'},
                    success: function (responce) {
                        if (responce.success) {
                            $('.header__top_account_balance span').html(responce.balance);
                            toastr.success("{{trans('pages/cabinet.sold')}} " + responce.success.modified_price + "{{trans('project_defs.currency_sign')}}", "{{trans('pages/cabinet.ok')}}");
                        }
                        if (responce.warning) {
                            toastr.warning(responce.info, "{{trans('pages/cabinet.warning')}}");
                        }
                        if (responce.error) {
                            toastr.error(responce.error, "{{trans('pages/cabinet.error')}}");
                        }
                        $("#cases-popup").fadeOut(300);

                        $("body").removeClass("blur");


                    }
                });
            }

        </script>
    @endauth

    @guest
        @if(isset($itsFirstCase)&&$itsFirstCase)
            <script src="{{\Illuminate\Support\Facades\URL::asset('js/auth-required.js')}}">
            </script>
        @else

            <script>
                var transit = 4000;

                function openCase() {
                    $('.cas__slider_bottom button').attr('disabled', 'disabled');
                    $.ajax({
                        type: "POST",
                        url: "/cases/" + "{{$case->id}}",
                        // url: window.location.pathname,
                        {{--data: {'case': "{{$case->id}}", 'boost': boost},--}}
                        data: {'case': "{{$case->id}}", 'fastOpen': fastOpen, locale: '{{app()->getLocale()}}'},
                        success: function (resp) {
                            if (resp.error) {
                                // $('#case_modal').niftyModal();
                                $('.cas__slider_bottom button').removeAttr('disabled');
                                return toastr.error(resp.error);
                            }
                            if (resp.success) {
                                $(".cas__slider_main .cas__slider_main_cont").shuffle();
                                $('.cas__slider_main')
                                    .transition({x: 0 + 'px'}, 0);

                                case_start.play();


                                if (resp.success.title.indexOf('|') !== -1) {
                                    $($('div.cas__slider_main_cont')[155]).html(
                                        '                                    <div class="cas__slider_main_block ' + resp.success.color + '">\n' +
                                        '                                        <img class="gun" src="' + resp.success.img + '" alt="gun tasty-case">\n' +
                                        '                                        <img class="item" src="/img/item01.svg" alt="gun tasty-case">\n' +
                                        '                                        <p class="ttl16"> ' + resp.success.title.substring(0, resp.success.title.indexOf('|')) + '' +
                                        '                                           <span>' + resp.success.title.substring((resp.success.title.indexOf('|') + 1)) + '</span>' +
                                        '                                        </p>\n' +
                                        '                                    </div>\n'
                                    );
                                } else {
                                    $($('div.cas__slider_main_cont')[155]).html(
                                        '                                    <div class="cas__slider_main_block ' + resp.success.color + '">\n' +
                                        '                                        <img class="gun" src="' + resp.success.img + '" alt="gun tasty-case">\n' +
                                        '                                        <img class="item" src="/img/item01.svg" alt="">\n' +
                                        '                                        <p class="ttl16"> <span>' + resp.success.title + '</span></p>\n' +
                                        '                                    </div>\n'
                                    );
                                }

                                let item_width = $($('div.cas__slider_main_cont')[155]).width();

                                let random = Math.random();
                                let markerOffset = $(".cas-slider").width() / 2 + 280 + 105;

                                let start_win_position = (155 * (item_width + 14)) - 260 - ($(".cas-slider").width() / 2);
                                var leftPosition = start_win_position + Math.floor(random * ((item_width + 8) - 7)) + 8;
                                console.log(leftPosition, random);
                                // get the offset of the marker for where a case lands on

                                // let item_width = $($('.r.item')[155]).width();
                                let last = 0; // last position a click was played at
                                $({tracker: 500}).animate({tracker: leftPosition}, {
                                    duration: fastOpen, easing: $.bez([.31, .9985, .31, .9985]),
                                    step: function (now) { // called every frame
                                        if (last < Math.floor((now - markerOffset - 70) / item_width)) {
                                            playClick();
                                            last = Math.floor((now - markerOffset - 70) / item_width);
                                        }
                                    }
                                });

                                $('div.cas__slider_main')
                                    .transition({x: '-' + leftPosition + 'px'}, fastOpen, 'cubic-bezier(.31,.9985,.31,.9985)', function () {
                                        rarity = resp.success.sound.toLowerCase();
                                        case_done[rarity].play();
                                        $("#win_field").removeAttr('class');
                                        $("#win_field").addClass('skinblock ' + resp.success.color);
                                        if (resp.success.title.indexOf('|') !== -1) {

                                            $("#win_field").html(
                                                '            <img class="gun" src="' + resp.success.img + '" alt="">\n' +
                                                '            <img class="item" src="/img/item02.svg" alt="">\n' +
                                                '            <p class="ttl"> <span>' + resp.success.title.substring(0, resp.success.title.indexOf('|')) + '</span>' +
                                                '                ' + resp.success.title.substring((resp.success.title.indexOf('|') + 1)) + '' +
                                                '            </p>\n'
                                            );
                                        } else {
                                            $("#win_field").html(
                                                '            <img class="gun" src="' + resp.success.img + '" alt="">\n' +
                                                '            <img class="item" src="/img/item02.svg" alt="">\n' +
                                                '            <p class="ttl"> <span>' + resp.success.title + '</span></p>\n'
                                            );

                                        }
                                        $("#case-nonauth").fadeIn(300);

                                        $("body").addClass("blur");


                                        $('.cas__slider_bottom button').removeAttr('disabled');
                                    }).removeClass('caseopening');
                            }
                            console.log(resp);
                        }
                    });

                }

            </script>
        @endif

    @endguest


@endsection
