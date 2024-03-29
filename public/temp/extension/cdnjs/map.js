/*
 Highmaps JS v5.0.7 (2017-01-17)
 Highmaps as a plugin for Highcharts 4.1.x or Highstock 2.1.x (x being the patch version of this file)

 (c) 2011-2016 Torstein Honsi

 License: www.highcharts.com/license
*/
(function(w) { "object" === typeof module && module.exports ? module.exports = w : w(Highcharts) })(function(w) {
    (function(a) {
        var k = a.Axis,
            n = a.each,
            g = a.pick;
        a = a.wrap;
        a(k.prototype, "getSeriesExtremes", function(a) {
            var e = this.isXAxis,
                p, u, r = [],
                l;
            e && n(this.series, function(b, a) { b.useMapGeometry && (r[a] = b.xData, b.xData = []) });
            a.call(this);
            e && (p = g(this.dataMin, Number.MAX_VALUE), u = g(this.dataMax, -Number.MAX_VALUE), n(this.series, function(a, f) {
                a.useMapGeometry && (p = Math.min(p, g(a.minX, p)), u = Math.max(u, g(a.maxX, p)), a.xData = r[f],
                    l = !0)
            }), l && (this.dataMin = p, this.dataMax = u))
        });
        a(k.prototype, "setAxisTranslation", function(a) {
            var e = this.chart,
                p = e.plotWidth / e.plotHeight,
                e = e.xAxis[0],
                g;
            a.call(this);
            "yAxis" === this.coll && void 0 !== e.transA && n(this.series, function(a) { a.preserveAspectRatio && (g = !0) });
            if (g && (this.transA = e.transA = Math.min(this.transA, e.transA), a = p / ((e.max - e.min) / (this.max - this.min)), a = 1 > a ? this : e, p = (a.max - a.min) * a.transA, a.pixelPadding = a.len - p, a.minPixelPadding = a.pixelPadding / 2, p = a.fixTo)) {
                p = p[1] - a.toValue(p[0], !0);
                p *= a.transA;
                if (Math.abs(p) > a.minPixelPadding || a.min === a.dataMin && a.max === a.dataMax) p = 0;
                a.minPixelPadding -= p
            }
        });
        a(k.prototype, "render", function(a) {
            a.call(this);
            this.fixTo = null
        })
    })(w);
    (function(a) {
        var k = a.Axis,
            n = a.Chart,
            g = a.color,
            e, t = a.each,
            p = a.extend,
            u = a.isNumber,
            r = a.Legend,
            l = a.LegendSymbolMixin,
            b = a.noop,
            f = a.merge,
            h = a.pick,
            q = a.wrap;
        e = a.ColorAxis = function() { this.init.apply(this, arguments) };
        p(e.prototype, k.prototype);
        p(e.prototype, {
            defaultColorAxisOptions: {
                lineWidth: 0,
                minPadding: 0,
                maxPadding: 0,
                gridLineWidth: 1,
                tickPixelInterval: 72,
                startOnTick: !0,
                endOnTick: !0,
                offset: 0,
                marker: { animation: { duration: 50 }, width: .01 },
                labels: { overflow: "justify", rotation: 0 },
                minColor: "#e6ebf5",
                maxColor: "#003399",
                tickLength: 5,
                showInLegend: !0
            },
            keepProps: ["legendGroup", "legendItem", "legendSymbol"].concat(k.prototype.keepProps),
            init: function(a, c) {
                var d = "vertical" !== a.options.legend.layout,
                    m;
                this.coll = "colorAxis";
                m = f(this.defaultColorAxisOptions, { side: d ? 2 : 1, reversed: !d }, c, { opposite: !d, showEmpty: !1, title: null });
                k.prototype.init.call(this, a, m);
                c.dataClasses &&
                    this.initDataClasses(c);
                this.initStops(c);
                this.horiz = d;
                this.zoomEnabled = !1;
                this.defaultLegendLength = 200
            },
            tweenColors: function(a, c, d) {
                var m;
                c.rgba.length && a.rgba.length ? (a = a.rgba, c = c.rgba, m = 1 !== c[3] || 1 !== a[3], a = (m ? "rgba(" : "rgb(") + Math.round(c[0] + (a[0] - c[0]) * (1 - d)) + "," + Math.round(c[1] + (a[1] - c[1]) * (1 - d)) + "," + Math.round(c[2] + (a[2] - c[2]) * (1 - d)) + (m ? "," + (c[3] + (a[3] - c[3]) * (1 - d)) : "") + ")") : a = c.input || "none";
                return a
            },
            initDataClasses: function(a) {
                var c = this,
                    d, m = 0,
                    b = this.chart.options.chart.colorCount,
                    l = this.options,
                    h = a.dataClasses.length;
                this.dataClasses = d = [];
                this.legendItems = [];
                t(a.dataClasses, function(a, x) {
                    a = f(a);
                    d.push(a);
                    a.color || ("category" === l.dataClassColor ? (a.colorIndex = m, m++, m === b && (m = 0)) : a.color = c.tweenColors(g(l.minColor), g(l.maxColor), 2 > h ? .5 : x / (h - 1)))
                })
            },
            initStops: function(a) {
                this.stops = a.stops || [
                    [0, this.options.minColor],
                    [1, this.options.maxColor]
                ];
                t(this.stops, function(a) { a.color = g(a[1]) })
            },
            setOptions: function(a) {
                k.prototype.setOptions.call(this, a);
                this.options.crosshair = this.options.marker
            },
            setAxisSize: function() {
                var a =
                    this.legendSymbol,
                    c = this.chart,
                    d = c.options.legend || {},
                    b, f;
                a ? (this.left = d = a.attr("x"), this.top = b = a.attr("y"), this.width = f = a.attr("width"), this.height = a = a.attr("height"), this.right = c.chartWidth - d - f, this.bottom = c.chartHeight - b - a, this.len = this.horiz ? f : a, this.pos = this.horiz ? d : b) : this.len = (this.horiz ? d.symbolWidth : d.symbolHeight) || this.defaultLegendLength
            },
            toColor: function(a, c) {
                var d = this.stops,
                    b, m, f = this.dataClasses,
                    l, h;
                if (f)
                    for (h = f.length; h--;) {
                        if (l = f[h], b = l.from, d = l.to, (void 0 === b || a >= b) && (void 0 ===
                                d || a <= d)) {
                            m = l.color;
                            c && (c.dataClass = h, c.colorIndex = l.colorIndex);
                            break
                        }
                    } else {
                        this.isLog && (a = this.val2lin(a));
                        a = 1 - (this.max - a) / (this.max - this.min || 1);
                        for (h = d.length; h-- && !(a > d[h][0]););
                        b = d[h] || d[h + 1];
                        d = d[h + 1] || b;
                        a = 1 - (d[0] - a) / (d[0] - b[0] || 1);
                        m = this.tweenColors(b.color, d.color, a)
                    }
                return m
            },
            getOffset: function() {
                var a = this.legendGroup,
                    c = this.chart.axisOffset[this.side];
                a && (this.axisParent = a, k.prototype.getOffset.call(this), this.added || (this.added = !0, this.labelLeft = 0, this.labelRight = this.width), this.chart.axisOffset[this.side] =
                    c)
            },
            setLegendColor: function() {
                var a, c = this.options,
                    d = this.reversed;
                a = d ? 1 : 0;
                d = d ? 0 : 1;
                a = this.horiz ? [a, 0, d, 0] : [0, d, 0, a];
                this.legendColor = {
                    linearGradient: { x1: a[0], y1: a[1], x2: a[2], y2: a[3] },
                    stops: c.stops || [
                        [0, c.minColor],
                        [1, c.maxColor]
                    ]
                }
            },
            drawLegendSymbol: function(a, c) {
                var d = a.padding,
                    b = a.options,
                    f = this.horiz,
                    l = h(b.symbolWidth, f ? this.defaultLegendLength : 12),
                    m = h(b.symbolHeight, f ? 12 : this.defaultLegendLength),
                    e = h(b.labelPadding, f ? 16 : 30),
                    b = h(b.itemDistance, 10);
                this.setLegendColor();
                c.legendSymbol = this.chart.renderer.rect(0,
                    a.baseline - 11, l, m).attr({ zIndex: 1 }).add(c.legendGroup);
                this.legendItemWidth = l + d + (f ? b : e);
                this.legendItemHeight = m + d + (f ? e : 0)
            },
            setState: b,
            visible: !0,
            setVisible: b,
            getSeriesExtremes: function() {
                var a = this.series,
                    c = a.length;
                this.dataMin = Infinity;
                for (this.dataMax = -Infinity; c--;) void 0 !== a[c].valueMin && (this.dataMin = Math.min(this.dataMin, a[c].valueMin), this.dataMax = Math.max(this.dataMax, a[c].valueMax))
            },
            drawCrosshair: function(a, c) {
                var d = c && c.plotX,
                    b = c && c.plotY,
                    f, l = this.pos,
                    h = this.len;
                c && (f = this.toPixels(c[c.series.colorKey]),
                    f < l ? f = l - 2 : f > l + h && (f = l + h + 2), c.plotX = f, c.plotY = this.len - f, k.prototype.drawCrosshair.call(this, a, c), c.plotX = d, c.plotY = b, this.cross && this.cross.addClass("highcharts-coloraxis-marker").add(this.legendGroup))
            },
            getPlotLinePath: function(a, c, d, b, f) { return u(f) ? this.horiz ? ["M", f - 4, this.top - 6, "L", f + 4, this.top - 6, f, this.top, "Z"] : ["M", this.left, f, "L", this.left - 6, f + 6, this.left - 6, f - 6, "Z"] : k.prototype.getPlotLinePath.call(this, a, c, d, b) },
            update: function(a, c) {
                var d = this.chart,
                    b = d.legend;
                t(this.series, function(a) {
                    a.isDirtyData = !0
                });
                a.dataClasses && b.allItems && (t(b.allItems, function(a) { a.isDataClass && a.legendGroup.destroy() }), d.isDirtyLegend = !0);
                d.options[this.coll] = f(this.userOptions, a);
                k.prototype.update.call(this, a, c);
                this.legendItem && (this.setLegendColor(), b.colorizeItem(this, !0))
            },
            getDataClassLegendSymbols: function() {
                var f = this,
                    c = this.chart,
                    d = this.legendItems,
                    h = c.options.legend,
                    e = h.valueDecimals,
                    q = h.valueSuffix || "",
                    g;
                d.length || t(this.dataClasses, function(h, m) {
                    var x = !0,
                        v = h.from,
                        n = h.to;
                    g = "";
                    void 0 === v ? g = "\x3c " : void 0 ===
                        n && (g = "\x3e ");
                    void 0 !== v && (g += a.numberFormat(v, e) + q);
                    void 0 !== v && void 0 !== n && (g += " - ");
                    void 0 !== n && (g += a.numberFormat(n, e) + q);
                    d.push(p({
                        chart: c,
                        name: g,
                        options: {},
                        drawLegendSymbol: l.drawRectangle,
                        visible: !0,
                        setState: b,
                        isDataClass: !0,
                        setVisible: function() {
                            x = this.visible = !x;
                            t(f.series, function(a) { t(a.points, function(a) { a.dataClass === m && a.setVisible(x) }) });
                            c.legend.colorizeItem(this, x)
                        }
                    }, h))
                });
                return d
            },
            name: ""
        });
        t(["fill", "stroke"], function(b) {
            a.Fx.prototype[b + "Setter"] = function() {
                this.elem.attr(b,
                    e.prototype.tweenColors(g(this.start), g(this.end), this.pos), null, !0)
            }
        });
        q(n.prototype, "getAxes", function(a) {
            var c = this.options.colorAxis;
            a.call(this);
            this.colorAxis = [];
            c && new e(this, c)
        });
        q(r.prototype, "getAllItems", function(a) {
            var c = [],
                d = this.chart.colorAxis[0];
            d && d.options && (d.options.showInLegend && (d.options.dataClasses ? c = c.concat(d.getDataClassLegendSymbols()) : c.push(d)), t(d.series, function(a) { a.options.showInLegend = !1 }));
            return c.concat(a.call(this))
        });
        q(r.prototype, "colorizeItem", function(a,
            c, d) {
            a.call(this, c, d);
            d && c.legendColor && c.legendSymbol.attr({ fill: c.legendColor })
        })
    })(w);
    (function(a) {
        var k = a.defined,
            n = a.each,
            g = a.noop;
        a.colorPointMixin = {
            isValid: function() { return null !== this.value },
            setVisible: function(a) {
                var e = this,
                    g = a ? "show" : "hide";
                n(["graphic", "dataLabel"], function(a) { if (e[a]) e[a][g]() })
            },
            setState: function(e) {
                a.Point.prototype.setState.call(this, e);
                this.graphic && this.graphic.attr({ zIndex: "hover" === e ? 1 : 0 })
            }
        };
        a.colorSeriesMixin = {
            pointArrayMap: ["value"],
            axisTypes: ["xAxis", "yAxis",
                "colorAxis"
            ],
            optionalAxis: "colorAxis",
            trackerGroups: ["group", "markerGroup", "dataLabelsGroup"],
            getSymbol: g,
            parallelArrays: ["x", "y", "value"],
            colorKey: "value",
            translateColors: function() {
                var a = this,
                    t = this.options.nullColor,
                    g = this.colorAxis,
                    k = this.colorKey;
                n(this.data, function(e) { var l = e[k]; if (l = e.options.color || (e.isNull ? t : g && void 0 !== l ? g.toColor(l, e) : e.color || a.color)) e.color = l })
            },
            colorAttribs: function(a) {
                var e = {};
                k(a.color) && (e[this.colorProp || "fill"] = a.color);
                return e
            }
        }
    })(w);
    (function(a) {
        function k(a) {
            a &&
                (a.preventDefault && a.preventDefault(), a.stopPropagation && a.stopPropagation(), a.cancelBubble = !0)
        }
        var n = a.addEvent,
            g = a.Chart,
            e = a.doc,
            t = a.each,
            p = a.extend,
            u = a.merge,
            r = a.pick;
        a = a.wrap;
        p(g.prototype, {
            renderMapNavigation: function() {
                var a = this,
                    b = this.options.mapNavigation,
                    f = b.buttons,
                    h, e, m, c = function(d) {
                        this.handler.call(a, d);
                        k(d)
                    };
                if (r(b.enableButtons, b.enabled) && !a.renderer.forExport)
                    for (h in a.mapNavButtons = [], f) f.hasOwnProperty(h) && (m = u(b.buttonOptions, f[h]), e = a.renderer.button(m.text, 0, 0, c, void 0, void 0,
                        void 0, 0, "zoomIn" === h ? "topbutton" : "bottombutton").addClass("highcharts-map-navigation").attr({ width: m.width, height: m.height, title: a.options.lang[h], padding: m.padding, zIndex: 5 }).add(), e.handler = m.onclick, e.align(p(m, { width: e.width, height: 2 * e.height }), null, m.alignTo), n(e.element, "dblclick", k), a.mapNavButtons.push(e))
            },
            fitToBox: function(a, b) {
                t([
                    ["x", "width"],
                    ["y", "height"]
                ], function(f) {
                    var h = f[0];
                    f = f[1];
                    a[h] + a[f] > b[h] + b[f] && (a[f] > b[f] ? (a[f] = b[f], a[h] = b[h]) : a[h] = b[h] + b[f] - a[f]);
                    a[f] > b[f] && (a[f] = b[f]);
                    a[h] < b[h] && (a[h] = b[h])
                });
                return a
            },
            mapZoom: function(a, b, f, h, e) {
                var m = this.xAxis[0],
                    c = m.max - m.min,
                    d = r(b, m.min + c / 2),
                    l = c * a,
                    c = this.yAxis[0],
                    v = c.max - c.min,
                    q = r(f, c.min + v / 2),
                    v = v * a,
                    d = this.fitToBox({ x: d - l * (h ? (h - m.pos) / m.len : .5), y: q - v * (e ? (e - c.pos) / c.len : .5), width: l, height: v }, { x: m.dataMin, y: c.dataMin, width: m.dataMax - m.dataMin, height: c.dataMax - c.dataMin }),
                    l = d.x <= m.dataMin && d.width >= m.dataMax - m.dataMin && d.y <= c.dataMin && d.height >= c.dataMax - c.dataMin;
                h && (m.fixTo = [h - m.pos, b]);
                e && (c.fixTo = [e - c.pos, f]);
                void 0 === a ||
                    l ? (m.setExtremes(void 0, void 0, !1), c.setExtremes(void 0, void 0, !1)) : (m.setExtremes(d.x, d.x + d.width, !1), c.setExtremes(d.y, d.y + d.height, !1));
                this.redraw()
            }
        });
        a(g.prototype, "render", function(a) {
            var b = this,
                f = b.options.mapNavigation;
            b.renderMapNavigation();
            a.call(b);
            (r(f.enableDoubleClickZoom, f.enabled) || f.enableDoubleClickZoomTo) && n(b.container, "dblclick", function(a) { b.pointer.onContainerDblClick(a) });
            r(f.enableMouseWheelZoom, f.enabled) && n(b.container, void 0 === e.onmousewheel ? "DOMMouseScroll" : "mousewheel",
                function(a) {
                    b.pointer.onContainerMouseWheel(a);
                    k(a);
                    return !1
                })
        })
    })(w);
    (function(a) {
        var k = a.extend,
            n = a.pick,
            g = a.Pointer;
        a = a.wrap;
        k(g.prototype, {
            onContainerDblClick: function(a) {
                var e = this.chart;
                a = this.normalize(a);
                e.options.mapNavigation.enableDoubleClickZoomTo ? e.pointer.inClass(a.target, "highcharts-tracker") && e.hoverPoint && e.hoverPoint.zoomTo() : e.isInsidePlot(a.chartX - e.plotLeft, a.chartY - e.plotTop) && e.mapZoom(.5, e.xAxis[0].toValue(a.chartX), e.yAxis[0].toValue(a.chartY), a.chartX, a.chartY)
            },
            onContainerMouseWheel: function(a) {
                var e =
                    this.chart,
                    g;
                a = this.normalize(a);
                g = a.detail || -(a.wheelDelta / 120);
                e.isInsidePlot(a.chartX - e.plotLeft, a.chartY - e.plotTop) && e.mapZoom(Math.pow(e.options.mapNavigation.mouseWheelSensitivity, g), e.xAxis[0].toValue(a.chartX), e.yAxis[0].toValue(a.chartY), a.chartX, a.chartY)
            }
        });
        a(g.prototype, "zoomOption", function(a) {
            var e = this.chart.options.mapNavigation;
            n(e.enableTouchZoom, e.enabled) && (this.chart.options.chart.pinchType = "xy");
            a.apply(this, [].slice.call(arguments, 1))
        });
        a(g.prototype, "pinchTranslate", function(a,
            g, n, k, r, l, b) { a.call(this, g, n, k, r, l, b); "map" === this.chart.options.chart.type && this.hasZoom && (a = k.scaleX > k.scaleY, this.pinchTranslateDirection(!a, g, n, k, r, l, b, a ? k.scaleX : k.scaleY)) })
    })(w);
    (function(a) {
        var k = a.colorPointMixin,
            n = a.each,
            g = a.extend,
            e = a.isNumber,
            t = a.map,
            p = a.merge,
            u = a.noop,
            r = a.pick,
            l = a.isArray,
            b = a.Point,
            f = a.Series,
            h = a.seriesType,
            q = a.seriesTypes,
            m = a.splat,
            c = void 0 !== a.doc.documentElement.style.vectorEffect;
        h("map", "scatter", {
            allAreas: !0,
            animation: !1,
            nullColor: "#f7f7f7",
            borderColor: "#cccccc",
            borderWidth: 1,
            marker: null,
            stickyTracking: !1,
            joinBy: "hc-key",
            dataLabels: { formatter: function() { return this.point.value }, inside: !0, verticalAlign: "middle", crop: !1, overflow: !1, padding: 0 },
            turboThreshold: 0,
            tooltip: { followPointer: !0, pointFormat: "{point.name}: {point.value}\x3cbr/\x3e" },
            states: { normal: { animation: !0 }, hover: { brightness: .2, halo: null }, select: { color: "#cccccc" } }
        }, p(a.colorSeriesMixin, {
            type: "map",
            supportsDrilldown: !0,
            getExtremesFromAll: !0,
            useMapGeometry: !0,
            forceDL: !0,
            searchPoint: u,
            directTouch: !0,
            preserveAspectRatio: !0,
            pointArrayMap: ["value"],
            getBox: function(d) {
                var c = Number.MAX_VALUE,
                    b = -c,
                    f = c,
                    h = -c,
                    l = c,
                    m = c,
                    q = this.xAxis,
                    g = this.yAxis,
                    k;
                n(d || [], function(d) {
                    if (d.path) {
                        "string" === typeof d.path && (d.path = a.splitPath(d.path));
                        var v = d.path || [],
                            q = v.length,
                            x = !1,
                            g = -c,
                            n = c,
                            p = -c,
                            A = c,
                            t = d.properties;
                        if (!d._foundBox) {
                            for (; q--;) e(v[q]) && (x ? (g = Math.max(g, v[q]), n = Math.min(n, v[q])) : (p = Math.max(p, v[q]), A = Math.min(A, v[q])), x = !x);
                            d._midX = n + (g - n) * (d.middleX || t && t["hc-middle-x"] || .5);
                            d._midY = A + (p - A) * (d.middleY || t && t["hc-middle-y"] ||
                                .5);
                            d._maxX = g;
                            d._minX = n;
                            d._maxY = p;
                            d._minY = A;
                            d.labelrank = r(d.labelrank, (g - n) * (p - A));
                            d._foundBox = !0
                        }
                        b = Math.max(b, d._maxX);
                        f = Math.min(f, d._minX);
                        h = Math.max(h, d._maxY);
                        l = Math.min(l, d._minY);
                        m = Math.min(d._maxX - d._minX, d._maxY - d._minY, m);
                        k = !0
                    }
                });
                k && (this.minY = Math.min(l, r(this.minY, c)), this.maxY = Math.max(h, r(this.maxY, -c)), this.minX = Math.min(f, r(this.minX, c)), this.maxX = Math.max(b, r(this.maxX, -c)), q && void 0 === q.options.minRange && (q.minRange = Math.min(5 * m, (this.maxX - this.minX) / 5, q.minRange || c)), g && void 0 ===
                    g.options.minRange && (g.minRange = Math.min(5 * m, (this.maxY - this.minY) / 5, g.minRange || c)))
            },
            getExtremes: function() {
                f.prototype.getExtremes.call(this, this.valueData);
                this.chart.hasRendered && this.isDirtyData && this.getBox(this.options.data);
                this.valueMin = this.dataMin;
                this.valueMax = this.dataMax;
                this.dataMin = this.minY;
                this.dataMax = this.maxY
            },
            translatePath: function(a) {
                var d = !1,
                    c = this.xAxis,
                    b = this.yAxis,
                    f = c.min,
                    h = c.transA,
                    c = c.minPixelPadding,
                    m = b.min,
                    l = b.transA,
                    b = b.minPixelPadding,
                    q, g = [];
                if (a)
                    for (q = a.length; q--;) e(a[q]) ?
                        (g[q] = d ? (a[q] - f) * h + c : (a[q] - m) * l + b, d = !d) : g[q] = a[q];
                return g
            },
            setData: function(d, c, b, h) {
                var q = this.options,
                    g = this.chart.options.chart,
                    v = g && g.map,
                    x = q.mapData,
                    k = q.joinBy,
                    r = null === k,
                    u = q.keys || this.pointArrayMap,
                    y = [],
                    C = {},
                    z, B = this.chart.mapTransforms;
                !x && v && (x = "string" === typeof v ? a.maps[v] : v);
                r && (k = "_i");
                k = this.joinBy = m(k);
                k[1] || (k[1] = k[0]);
                d && n(d, function(a, c) {
                    var b = 0;
                    if (e(a)) d[c] = { value: a };
                    else if (l(a)) {
                        d[c] = {};
                        !q.keys && a.length > u.length && "string" === typeof a[0] && (d[c]["hc-key"] = a[0], ++b);
                        for (var f = 0; f <
                            u.length; ++f, ++b) u[f] && (d[c][u[f]] = a[b])
                    }
                    r && (d[c]._i = c)
                });
                this.getBox(d);
                if (this.chart.mapTransforms = B = g && g.mapTransforms || x && x["hc-transform"] || B)
                    for (z in B) B.hasOwnProperty(z) && z.rotation && (z.cosAngle = Math.cos(z.rotation), z.sinAngle = Math.sin(z.rotation));
                if (x) {
                    "FeatureCollection" === x.type && (this.mapTitle = x.title, x = a.geojson(x, this.type, this));
                    this.mapData = x;
                    this.mapMap = {};
                    for (z = 0; z < x.length; z++) g = x[z], v = g.properties, g._i = z, k[0] && v && v[k[0]] && (g[k[0]] = v[k[0]]), C[g[k[0]]] = g;
                    this.mapMap = C;
                    d && k[1] &&
                        n(d, function(a) { C[a[k[1]]] && y.push(C[a[k[1]]]) });
                    q.allAreas ? (this.getBox(x), d = d || [], k[1] && n(d, function(a) { y.push(a[k[1]]) }), y = "|" + t(y, function(a) { return a && a[k[0]] }).join("|") + "|", n(x, function(a) { k[0] && -1 !== y.indexOf("|" + a[k[0]] + "|") || (d.push(p(a, { value: null })), h = !1) })) : this.getBox(y)
                }
                f.prototype.setData.call(this, d, c, b, h)
            },
            drawGraph: u,
            drawDataLabels: u,
            doFullTranslate: function() { return this.isDirtyData || this.chart.isResizing || this.chart.renderer.isVML || !this.baseTrans },
            translate: function() {
                var a =
                    this,
                    c = a.xAxis,
                    b = a.yAxis,
                    f = a.doFullTranslate();
                a.generatePoints();
                n(a.data, function(d) {
                    d.plotX = c.toPixels(d._midX, !0);
                    d.plotY = b.toPixels(d._midY, !0);
                    f && (d.shapeType = "path", d.shapeArgs = { d: a.translatePath(d.path) })
                });
                a.translateColors()
            },
            pointAttribs: function(a, b) {
                b = this.colorAttribs(a);
                a.isFading && delete b.fill;
                c ? b["vector-effect"] = "non-scaling-stroke" : b["stroke-width"] = "inherit";
                return b
            },
            drawPoints: function() {
                var a = this,
                    b = a.xAxis,
                    f = a.yAxis,
                    h = a.group,
                    m = a.chart,
                    l = m.renderer,
                    e, g, k, p, t = this.baseTrans,
                    y, r, u, B, w;
                a.transformGroup || (a.transformGroup = l.g().attr({ scaleX: 1, scaleY: 1 }).add(h), a.transformGroup.survive = !0);
                a.doFullTranslate() ? (a.group = a.transformGroup, q.column.prototype.drawPoints.apply(a), a.group = h, n(a.points, function(d) { d.graphic && (d.name && d.graphic.addClass("highcharts-name-" + d.name.replace(/ /g, "-").toLowerCase()), d.properties && d.properties["hc-key"] && d.graphic.addClass("highcharts-key-" + d.properties["hc-key"].toLowerCase()), d.graphic.css(a.pointAttribs(d, d.selected && "select"))) }), this.baseTrans = { originX: b.min - b.minPixelPadding / b.transA, originY: f.min - f.minPixelPadding / f.transA + (f.reversed ? 0 : f.len / f.transA), transAX: b.transA, transAY: f.transA }, this.transformGroup.animate({ translateX: 0, translateY: 0, scaleX: 1, scaleY: 1 })) : (e = b.transA / t.transAX, g = f.transA / t.transAY, k = b.toPixels(t.originX, !0), p = f.toPixels(t.originY, !0), .99 < e && 1.01 > e && .99 < g && 1.01 > g && (g = e = 1, k = Math.round(k), p = Math.round(p)), y = this.transformGroup, m.renderer.globalAnimation ? (r = y.attr("translateX"), u = y.attr("translateY"), B = y.attr("scaleX"),
                    w = y.attr("scaleY"), y.attr({ animator: 0 }).animate({ animator: 1 }, { step: function(a, d) { y.attr({ translateX: r + (k - r) * d.pos, translateY: u + (p - u) * d.pos, scaleX: B + (e - B) * d.pos, scaleY: w + (g - w) * d.pos }) } })) : y.attr({ translateX: k, translateY: p, scaleX: e, scaleY: g }));
                c || a.group.element.setAttribute("stroke-width", a.options[a.pointAttrToOptions && a.pointAttrToOptions["stroke-width"] || "borderWidth"] / (e || 1));
                this.drawMapDataLabels()
            },
            drawMapDataLabels: function() {
                f.prototype.drawDataLabels.call(this);
                this.dataLabelsGroup && this.dataLabelsGroup.clip(this.chart.clipRect)
            },
            render: function() {
                var a = this,
                    c = f.prototype.render;
                a.chart.renderer.isVML && 3E3 < a.data.length ? setTimeout(function() { c.call(a) }) : c.call(a)
            },
            animate: function(a) {
                var d = this.options.animation,
                    c = this.group,
                    b = this.xAxis,
                    f = this.yAxis,
                    h = b.pos,
                    m = f.pos;
                this.chart.renderer.isSVG && (!0 === d && (d = { duration: 1E3 }), a ? c.attr({ translateX: h + b.len / 2, translateY: m + f.len / 2, scaleX: .001, scaleY: .001 }) : (c.animate({ translateX: h, translateY: m, scaleX: 1, scaleY: 1 }, d), this.animate = null))
            },
            animateDrilldown: function(a) {
                var d = this.chart.plotBox,
                    c = this.chart.drilldownLevels[this.chart.drilldownLevels.length - 1],
                    b = c.bBox,
                    f = this.chart.options.drilldown.animation;
                a || (a = Math.min(b.width / d.width, b.height / d.height), c.shapeArgs = { scaleX: a, scaleY: a, translateX: b.x, translateY: b.y }, n(this.points, function(a) { a.graphic && a.graphic.attr(c.shapeArgs).animate({ scaleX: 1, scaleY: 1, translateX: 0, translateY: 0 }, f) }), this.animate = null)
            },
            drawLegendSymbol: a.LegendSymbolMixin.drawRectangle,
            animateDrillupFrom: function(a) {
                q.column.prototype.animateDrillupFrom.call(this,
                    a)
            },
            animateDrillupTo: function(a) { q.column.prototype.animateDrillupTo.call(this, a) }
        }), g({
            applyOptions: function(a, c) {
                a = b.prototype.applyOptions.call(this, a, c);
                c = this.series;
                var d = c.joinBy;
                c.mapData && ((d = void 0 !== a[d[1]] && c.mapMap[a[d[1]]]) ? (c.xyFromShape && (a.x = d._midX, a.y = d._midY), g(a, d)) : a.value = a.value || null);
                return a
            },
            onMouseOver: function(a) {
                clearTimeout(this.colorInterval);
                if (null !== this.value) b.prototype.onMouseOver.call(this, a);
                else this.series.onMouseOut(a)
            },
            zoomTo: function() {
                var a = this.series;
                a.xAxis.setExtremes(this._minX, this._maxX, !1);
                a.yAxis.setExtremes(this._minY, this._maxY, !1);
                a.chart.redraw()
            }
        }, k))
    })(w);
    (function(a) {
        var k = a.seriesType;
        k("mapline", "map", {}, { type: "mapline", colorProp: "stroke", drawLegendSymbol: a.seriesTypes.line.prototype.drawLegendSymbol })
    })(w);
    (function(a) {
        var k = a.merge,
            n = a.Point;
        a = a.seriesType;
        a("mappoint", "scatter", { dataLabels: { enabled: !0, formatter: function() { return this.point.name }, crop: !1, defer: !1, overflow: !1, style: { color: "#000000" } } }, { type: "mappoint", forceDL: !0 }, { applyOptions: function(a, e) { a = void 0 !== a.lat && void 0 !== a.lon ? k(a, this.series.chart.fromLatLonToPoint(a)) : a; return n.prototype.applyOptions.call(this, a, e) } })
    })(w);
    (function(a) {
        var k = a.arrayMax,
            n = a.arrayMin,
            g = a.Axis,
            e = a.each,
            t = a.isNumber,
            p = a.noop,
            u = a.pick,
            r = a.pInt,
            l = a.Point,
            b = a.seriesType,
            f = a.seriesTypes;
        b("bubble", "scatter", {
            dataLabels: { formatter: function() { return this.point.z }, inside: !0, verticalAlign: "middle" },
            marker: { radius: null, states: { hover: { radiusPlus: 0 } }, symbol: "circle" },
            minSize: 8,
            maxSize: "20%",
            softThreshold: !1,
            states: { hover: { halo: { size: 5 } } },
            tooltip: { pointFormat: "({point.x}, {point.y}), Size: {point.z}" },
            turboThreshold: 0,
            zThreshold: 0,
            zoneAxis: "z"
        }, {
            pointArrayMap: ["y", "z"],
            parallelArrays: ["x", "y", "z"],
            trackerGroups: ["markerGroup", "dataLabelsGroup"],
            bubblePadding: !0,
            zoneAxis: "z",
            getRadii: function(a, b, f, c) {
                var d, h, e, m = this.zData,
                    l = [],
                    g = this.options,
                    q = "width" !== g.sizeBy,
                    k = g.zThreshold,
                    n = b - a;
                h = 0;
                for (d = m.length; h < d; h++) e = m[h], g.sizeByAbsoluteValue && null !== e && (e = Math.abs(e - k), b = Math.max(b - k, Math.abs(a -
                    k)), a = 0), null === e ? e = null : e < a ? e = f / 2 - 1 : (e = 0 < n ? (e - a) / n : .5, q && 0 <= e && (e = Math.sqrt(e)), e = Math.ceil(f + e * (c - f)) / 2), l.push(e);
                this.radii = l
            },
            animate: function(a) {
                var b = this.options.animation;
                a || (e(this.points, function(a) {
                    var c = a.graphic,
                        d;
                    c && c.width && (d = { x: c.x, y: c.y, width: c.width, height: c.height }, c.attr({ x: a.plotX, y: a.plotY, width: 1, height: 1 }), c.animate(d, b))
                }), this.animate = null)
            },
            translate: function() {
                var a, b = this.data,
                    e, c, d = this.radii;
                f.scatter.prototype.translate.call(this);
                for (a = b.length; a--;) e = b[a], c = d ? d[a] :
                    0, t(c) && c >= this.minPxSize / 2 ? (e.marker = { radius: c, width: 2 * c, height: 2 * c }, e.dlBox = { x: e.plotX - c, y: e.plotY - c, width: 2 * c, height: 2 * c }) : e.shapeArgs = e.plotY = e.dlBox = void 0
            },
            alignDataLabel: f.column.prototype.alignDataLabel,
            buildKDTree: p,
            applyZones: p
        }, { haloPath: function(a) { return l.prototype.haloPath.call(this, 0 === a ? 0 : this.marker.radius + a) }, ttBelow: !1 });
        g.prototype.beforePadding = function() {
            var a = this,
                b = this.len,
                f = this.chart,
                c = 0,
                d = b,
                l = this.isXAxis,
                g = l ? "xData" : "yData",
                p = this.min,
                w = {},
                H = Math.min(f.plotWidth, f.plotHeight),
                E = Number.MAX_VALUE,
                F = -Number.MAX_VALUE,
                A = this.max - p,
                D = b / A,
                G = [];
            e(this.series, function(b) {
                var c = b.options;
                !b.bubblePadding || !b.visible && f.options.chart.ignoreHiddenSeries || (a.allowZoomOutside = !0, G.push(b), l && (e(["minSize", "maxSize"], function(a) {
                    var b = c[a],
                        d = /%$/.test(b),
                        b = r(b);
                    w[a] = d ? H * b / 100 : b
                }), b.minPxSize = w.minSize, b.maxPxSize = Math.max(w.maxSize, w.minSize), b = b.zData, b.length && (E = u(c.zMin, Math.min(E, Math.max(n(b), !1 === c.displayNegative ? c.zThreshold : -Number.MAX_VALUE))), F = u(c.zMax, Math.max(F, k(b))))))
            });
            e(G, function(b) {
                var f = b[g],
                    e = f.length,
                    h;
                l && b.getRadii(E, F, b.minPxSize, b.maxPxSize);
                if (0 < A)
                    for (; e--;) t(f[e]) && a.dataMin <= f[e] && f[e] <= a.dataMax && (h = b.radii[e], c = Math.min((f[e] - p) * D - h, c), d = Math.max((f[e] - p) * D + h, d))
            });
            G.length && 0 < A && !this.isLog && (d -= b, D *= (b + c - d) / b, e([
                ["min", "userMin", c],
                ["max", "userMax", d]
            ], function(b) { void 0 === u(a.options[b[0]], a[b[1]]) && (a[b[0]] += b[2] / D) }))
        }
    })(w);
    (function(a) {
        var k = a.merge,
            n = a.Point,
            g = a.seriesType,
            e = a.seriesTypes;
        e.bubble && g("mapbubble", "bubble", {
            animationLimit: 500,
            tooltip: { pointFormat: "{point.name}: {point.z}" }
        }, { xyFromShape: !0, type: "mapbubble", pointArrayMap: ["z"], getMapData: e.map.prototype.getMapData, getBox: e.map.prototype.getBox, setData: e.map.prototype.setData }, { applyOptions: function(a, g) { return a && void 0 !== a.lat && void 0 !== a.lon ? n.prototype.applyOptions.call(this, k(a, this.series.chart.fromLatLonToPoint(a)), g) : e.map.prototype.pointClass.prototype.applyOptions.call(this, a, g) }, ttBelow: !1 })
    })(w);
    (function(a) {
        var k = a.colorPointMixin,
            n = a.each,
            g = a.merge,
            e = a.noop,
            t = a.pick,
            p = a.Series,
            u = a.seriesType,
            r = a.seriesTypes;
        u("heatmap", "scatter", { animation: !1, borderWidth: 0, dataLabels: { formatter: function() { return this.point.value }, inside: !0, verticalAlign: "middle", crop: !1, overflow: !1, padding: 0 }, marker: null, pointRange: null, tooltip: { pointFormat: "{point.x}, {point.y}: {point.value}\x3cbr/\x3e" }, states: { normal: { animation: !0 }, hover: { halo: !1, brightness: .2 } } }, g(a.colorSeriesMixin, {
            pointArrayMap: ["y", "value"],
            hasPointSpecificOptions: !0,
            supportsDrilldown: !0,
            getExtremesFromAll: !0,
            directTouch: !0,
            init: function() {
                var a;
                r.scatter.prototype.init.apply(this, arguments);
                a = this.options;
                a.pointRange = t(a.pointRange, a.colsize || 1);
                this.yAxis.axisPointRange = a.rowsize || 1
            },
            translate: function() {
                var a = this.options,
                    b = this.xAxis,
                    f = this.yAxis,
                    e = function(a, b, c) { return Math.min(Math.max(b, a), c) };
                this.generatePoints();
                n(this.points, function(h) {
                    var l = (a.colsize || 1) / 2,
                        c = (a.rowsize || 1) / 2,
                        d = e(Math.round(b.len - b.translate(h.x - l, 0, 1, 0, 1)), -b.len, 2 * b.len),
                        l = e(Math.round(b.len - b.translate(h.x + l, 0, 1, 0, 1)), -b.len, 2 * b.len),
                        g = e(Math.round(f.translate(h.y - c, 0, 1, 0, 1)), -f.len, 2 * f.len),
                        c = e(Math.round(f.translate(h.y + c, 0, 1, 0, 1)), -f.len, 2 * f.len);
                    h.plotX = h.clientX = (d + l) / 2;
                    h.plotY = (g + c) / 2;
                    h.shapeType = "rect";
                    h.shapeArgs = { x: Math.min(d, l), y: Math.min(g, c), width: Math.abs(l - d), height: Math.abs(c - g) }
                });
                this.translateColors()
            },
            drawPoints: function() {
                r.column.prototype.drawPoints.call(this);
                n(this.points, function(a) { a.graphic.css(this.colorAttribs(a)) }, this)
            },
            animate: e,
            getBox: e,
            drawLegendSymbol: a.LegendSymbolMixin.drawRectangle,
            alignDataLabel: r.column.prototype.alignDataLabel,
            getExtremes: function() {
                p.prototype.getExtremes.call(this, this.valueData);
                this.valueMin = this.dataMin;
                this.valueMax = this.dataMax;
                p.prototype.getExtremes.call(this)
            }
        }), k)
    })(w);
    (function(a) {
        function k(a, b) {
            var f, e, g, l = !1,
                c = a.x,
                d = a.y;
            a = 0;
            for (f = b.length - 1; a < b.length; f = a++) e = b[a][1] > d, g = b[f][1] > d, e !== g && c < (b[f][0] - b[a][0]) * (d - b[a][1]) / (b[f][1] - b[a][1]) + b[a][0] && (l = !l);
            return l
        }
        var n = a.Chart,
            g = a.each,
            e = a.extend,
            t = a.format,
            p = a.merge,
            u = a.win,
            r = a.wrap;
        n.prototype.transformFromLatLon =
            function(e, b) {
                if (void 0 === u.proj4) return a.error(21), { x: 0, y: null };
                e = u.proj4(b.crs, [e.lon, e.lat]);
                var f = b.cosAngle || b.rotation && Math.cos(b.rotation),
                    h = b.sinAngle || b.rotation && Math.sin(b.rotation);
                e = b.rotation ? [e[0] * f + e[1] * h, -e[0] * h + e[1] * f] : e;
                return { x: ((e[0] - (b.xoffset || 0)) * (b.scale || 1) + (b.xpan || 0)) * (b.jsonres || 1) + (b.jsonmarginX || 0), y: (((b.yoffset || 0) - e[1]) * (b.scale || 1) + (b.ypan || 0)) * (b.jsonres || 1) - (b.jsonmarginY || 0) }
            };
        n.prototype.transformToLatLon = function(e, b) {
            if (void 0 === u.proj4) a.error(21);
            else {
                e = { x: ((e.x - (b.jsonmarginX || 0)) / (b.jsonres || 1) - (b.xpan || 0)) / (b.scale || 1) + (b.xoffset || 0), y: ((-e.y - (b.jsonmarginY || 0)) / (b.jsonres || 1) + (b.ypan || 0)) / (b.scale || 1) + (b.yoffset || 0) };
                var f = b.cosAngle || b.rotation && Math.cos(b.rotation),
                    h = b.sinAngle || b.rotation && Math.sin(b.rotation);
                b = u.proj4(b.crs, "WGS84", b.rotation ? { x: e.x * f + e.y * -h, y: e.x * h + e.y * f } : e);
                return { lat: b.y, lon: b.x }
            }
        };
        n.prototype.fromPointToLatLon = function(e) {
            var b = this.mapTransforms,
                f;
            if (b) {
                for (f in b)
                    if (b.hasOwnProperty(f) && b[f].hitZone && k({ x: e.x, y: -e.y },
                            b[f].hitZone.coordinates[0])) return this.transformToLatLon(e, b[f]);
                return this.transformToLatLon(e, b["default"])
            }
            a.error(22)
        };
        n.prototype.fromLatLonToPoint = function(e) {
            var b = this.mapTransforms,
                f, h;
            if (!b) return a.error(22), { x: 0, y: null };
            for (f in b)
                if (b.hasOwnProperty(f) && b[f].hitZone && (h = this.transformFromLatLon(e, b[f]), k({ x: h.x, y: -h.y }, b[f].hitZone.coordinates[0]))) return h;
            return this.transformFromLatLon(e, b["default"])
        };
        a.geojson = function(a, b, f) {
            var h = [],
                k = [],
                m = function(a) {
                    var b, c = a.length;
                    k.push("M");
                    for (b = 0; b < c; b++) 1 === b && k.push("L"), k.push(a[b][0], -a[b][1])
                };
            b = b || "map";
            g(a.features, function(a) {
                var c = a.geometry,
                    f = c.type,
                    c = c.coordinates;
                a = a.properties;
                var l;
                k = [];
                "map" === b || "mapbubble" === b ? ("Polygon" === f ? (g(c, m), k.push("Z")) : "MultiPolygon" === f && (g(c, function(a) { g(a, m) }), k.push("Z")), k.length && (l = { path: k })) : "mapline" === b ? ("LineString" === f ? m(c) : "MultiLineString" === f && g(c, m), k.length && (l = { path: k })) : "mappoint" === b && "Point" === f && (l = { x: c[0], y: -c[1] });
                l && h.push(e(l, { name: a.name || a.NAME, properties: a }))
            });
            f && a.copyrightShort && (f.chart.mapCredits = t(f.chart.options.credits.mapText, { geojson: a }), f.chart.mapCreditsFull = t(f.chart.options.credits.mapTextFull, { geojson: a }));
            return h
        };
        r(n.prototype, "addCredits", function(a, b) {
            b = p(!0, this.options.credits, b);
            this.mapCredits && (b.href = null);
            a.call(this, b);
            this.credits && this.mapCreditsFull && this.credits.attr({ title: this.mapCreditsFull })
        })
    })(w);
    (function(a) {
        function k(a, b, e, g, c, d, k, l) {
            return ["M", a + c, b, "L", a + e - d, b, "C", a + e - d / 2, b, a + e, b + d / 2, a + e, b + d, "L", a + e, b + g - k, "C", a +
                e, b + g - k / 2, a + e - k / 2, b + g, a + e - k, b + g, "L", a + l, b + g, "C", a + l / 2, b + g, a, b + g - l / 2, a, b + g - l, "L", a, b + c, "C", a, b + c / 2, a + c / 2, b, a + c, b, "Z"
            ]
        }
        var n = a.Chart,
            g = a.defaultOptions,
            e = a.each,
            t = a.extend,
            p = a.merge,
            u = a.pick,
            r = a.Renderer,
            l = a.SVGRenderer,
            b = a.VMLRenderer;
        t(g.lang, { zoomIn: "Zoom in", zoomOut: "Zoom out" });
        g.mapNavigation = {
            buttonOptions: { alignTo: "plotBox", align: "left", verticalAlign: "top", x: 0, width: 18, height: 18, padding: 5 },
            buttons: {
                zoomIn: { onclick: function() { this.mapZoom(.5) }, text: "+", y: 0 },
                zoomOut: {
                    onclick: function() { this.mapZoom(2) },
                    text: "-",
                    y: 28
                }
            },
            mouseWheelSensitivity: 1.1
        };
        a.splitPath = function(a) {
            var b;
            a = a.replace(/([A-Za-z])/g, " $1 ");
            a = a.replace(/^\s*/, "").replace(/\s*$/, "");
            a = a.split(/[ ,]+/);
            for (b = 0; b < a.length; b++) /[a-zA-Z]/.test(a[b]) || (a[b] = parseFloat(a[b]));
            return a
        };
        a.maps = {};
        l.prototype.symbols.topbutton = function(a, b, e, g, c) { return k(a - 1, b - 1, e, g, c.r, c.r, 0, 0) };
        l.prototype.symbols.bottombutton = function(a, b, e, g, c) { return k(a - 1, b - 1, e, g, 0, 0, c.r, c.r) };
        r === b && e(["topbutton", "bottombutton"], function(a) {
            b.prototype.symbols[a] =
                l.prototype.symbols[a]
        });
        a.Map = a.mapChart = function(b, e, g) {
            var f = "string" === typeof b || b.nodeName,
                c = arguments[f ? 1 : 0],
                d = { endOnTick: !1, visible: !1, minPadding: 0, maxPadding: 0, startOnTick: !1 },
                h, k = a.getOptions().credits;
            h = c.series;
            c.series = null;
            c = p({ chart: { panning: "xy", type: "map" }, credits: { mapText: u(k.mapText, ' \u00a9 \x3ca href\x3d"{geojson.copyrightUrl}"\x3e{geojson.copyrightShort}\x3c/a\x3e'), mapTextFull: u(k.mapTextFull, "{geojson.copyright}") }, tooltip: { followTouchMove: !1 }, xAxis: d, yAxis: p(d, { reversed: !0 }) },
                c, { chart: { inverted: !1, alignTicks: !1 } });
            c.series = h;
            return f ? new n(b, c, g) : new n(c, e)
        }
    })(w)
});