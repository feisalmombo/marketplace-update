/*
 Highcharts JS v5.0.7 (2017-01-17)
 Client side exporting module

 (c) 2015 Torstein Honsi / Oystein Moseng

 License: www.highcharts.com/license
*/
(function(n) { "object" === typeof module && module.exports ? module.exports = n : n(Highcharts) })(function(n) {
    (function(d) {
        function n(a, d) {
            var c = t.getElementsByTagName("head")[0],
                b = t.createElement("script");
            b.type = "text/javascript";
            b.src = a;
            b.onload = d;
            b.onerror = function() { console.error("Error loading script", a) };
            c.appendChild(b)
        }
        var C = d.merge,
            e = d.win,
            r = e.navigator,
            t = e.document,
            z = d.each,
            w = e.URL || e.webkitURL || e,
            B = /Edge\/|Trident\/|MSIE /.test(r.userAgent),
            D = /Edge\/\d+/.test(r.userAgent),
            E = B ? 150 : 0;
        d.CanVGRenderer = {};
        d.dataURLtoBlob = function(a) {
            if (e.atob && e.ArrayBuffer && e.Uint8Array && e.Blob && w.createObjectURL) {
                a = a.match(/data:([^;]*)(;base64)?,([0-9A-Za-z+/]+)/);
                for (var d = e.atob(a[3]), c = new e.ArrayBuffer(d.length), c = new e.Uint8Array(c), b = 0; b < c.length; ++b) c[b] = d.charCodeAt(b);
                a = new e.Blob([c], { type: a[1] });
                return w.createObjectURL(a)
            }
        };
        d.downloadURL = function(a, f) {
            var c = t.createElement("a"),
                b;
            if (r.msSaveOrOpenBlob) r.msSaveOrOpenBlob(a, f);
            else {
                if (2E6 < a.length && (a = d.dataURLtoBlob(a), !a)) throw "Data URL length limit reached";
                if (void 0 !== c.download) c.href = a, c.download = f, c.target = "_blank", t.body.appendChild(c), c.click(), t.body.removeChild(c);
                else try { if (b = e.open(a, "chart"), void 0 === b || null === b) throw "Failed to open window"; } catch (u) { e.location.href = a }
            }
        };
        d.svgToDataUrl = function(a) {
            var d = -1 < r.userAgent.indexOf("WebKit") && 0 > r.userAgent.indexOf("Chrome");
            try { if (!d && 0 > r.userAgent.toLowerCase().indexOf("firefox")) return w.createObjectURL(new e.Blob([a], { type: "image/svg+xml;charset-utf-16" })) } catch (c) {}
            return "data:image/svg+xml;charset\x3dUTF-8," +
                encodeURIComponent(a)
        };
        d.imageToDataUrl = function(a, d, c, b, u, l, k, m, p) {
            var g = new e.Image,
                h, f = function() {
                    setTimeout(function() {
                        var e = t.createElement("canvas"),
                            f = e.getContext && e.getContext("2d"),
                            x;
                        try {
                            if (f) {
                                e.height = g.height * b;
                                e.width = g.width * b;
                                f.drawImage(g, 0, 0, e.width, e.height);
                                try { x = e.toDataURL(d), u(x, d, c, b) } catch (F) { h(a, d, c, b) }
                            } else k(a, d, c, b)
                        } finally { p && p(a, d, c, b) }
                    }, E)
                },
                q = function() {
                    m(a, d, c, b);
                    p && p(a, d, c, b)
                };
            h = function() {
                g = new e.Image;
                h = l;
                g.crossOrigin = "Anonymous";
                g.onload = f;
                g.onerror = q;
                g.src = a
            };
            g.onload = f;
            g.onerror = q;
            g.src = a
        };
        d.downloadSVGLocal = function(a, f, c, b) {
            function u(b, a) {
                a = new e.jsPDF("l", "pt", [b.width.baseVal.value + 2 * a, b.height.baseVal.value + 2 * a]);
                e.svg2pdf(b, a, { removeInvalid: !0 });
                return a.output("datauristring")
            }

            function l() {
                y.innerHTML = a;
                var e = y.getElementsByTagName("text"),
                    g, f = y.getElementsByTagName("svg")[0].style;
                z(e, function(b) {
                    z(["font-family", "font-size"], function(a) {!b.style[a] && f[a] && (b.style[a] = f[a]) });
                    b.style["font-family"] = b.style["font-family"] && b.style["font-family"].split(" ").splice(-1);
                    g = b.getElementsByTagName("title");
                    z(g, function(a) { b.removeChild(a) })
                });
                e = u(y.firstChild, 0);
                try { d.downloadURL(e, v), b && b() } catch (G) { c() }
            }
            var k, m, p = !0,
                g, h = f.libURL || d.getOptions().exporting.libURL,
                y = t.createElement("div"),
                q = f.type || "image/png",
                v = (f.filename || "chart") + "." + ("image/svg+xml" === q ? "svg" : q.split("/")[1]),
                A = f.scale || 1,
                h = "/" !== h.slice(-1) ? h + "/" : h;
            if ("image/svg+xml" === q) try {
                r.msSaveOrOpenBlob ? (m = new MSBlobBuilder, m.append(a), k = m.getBlob("image/svg+xml")) : k = d.svgToDataUrl(a), d.downloadURL(k, v),
                    b && b()
            } catch (x) { c() } else "application/pdf" === q ? e.jsPDF && e.svg2pdf ? l() : (p = !0, n(h + "jspdf.js", function() { n(h + "svg2pdf.js", function() { l() }) })) : (k = d.svgToDataUrl(a), g = function() { try { w.revokeObjectURL(k) } catch (x) {} }, d.imageToDataUrl(k, q, {}, A, function(a) { try { d.downloadURL(a, v), b && b() } catch (F) { c() } }, function() {
                var f = t.createElement("canvas"),
                    u = f.getContext("2d"),
                    l = a.match(/^<svg[^>]*width\s*=\s*\"?(\d+)\"?[^>]*>/)[1] * A,
                    k = a.match(/^<svg[^>]*height\s*=\s*\"?(\d+)\"?[^>]*>/)[1] * A,
                    m = function() {
                        u.drawSvg(a, 0, 0,
                            l, k);
                        try { d.downloadURL(r.msSaveOrOpenBlob ? f.msToBlob() : f.toDataURL(q), v), b && b() } catch (H) { c() } finally { g() }
                    };
                f.width = l;
                f.height = k;
                e.canvg ? m() : (p = !0, n(h + "rgbcolor.js", function() { n(h + "canvg.js", function() { m() }) }))
            }, c, c, function() { p && g() }))
        };
        d.Chart.prototype.getSVGForLocalExport = function(a, e, c, b) {
            var f = this,
                l, k = 0,
                m, p, g, h, n, q = function(a, d, c) {
                    ++k;
                    c.imageElement.setAttributeNS("http://www.w3.org/1999/xlink", "href", a);
                    k === l.length && b(f.sanitizeSVG(m.innerHTML, p))
                };
            d.wrap(d.Chart.prototype, "getChartHTML",
                function(b) {
                    var a = b.apply(this, Array.prototype.slice.call(arguments, 1));
                    p = this.options;
                    m = this.container.cloneNode(!0);
                    return a
                });
            f.getSVGForExport(a, e);
            l = m.getElementsByTagName("image");
            try {
                if (l.length)
                    for (h = 0, n = l.length; h < n; ++h) g = l[h], d.imageToDataUrl(g.getAttributeNS("http://www.w3.org/1999/xlink", "href"), "image/png", { imageElement: g }, a.scale, q, c, c, c);
                else b(f.sanitizeSVG(m.innerHTML, p))
            } catch (v) { c() }
        };
        d.Chart.prototype.exportChartLocal = function(a, e) {
            var c = this,
                b = d.merge(c.options.exporting, a),
                f =
                function() {
                    if (!1 === b.fallbackToExportServer)
                        if (b.error) b.error(b);
                        else throw "Fallback to export server disabled";
                    else c.exportChart(b)
                };
            B && ("application/pdf" === b.type || c.container.getElementsByTagName("image").length && "image/svg+xml" !== b.type) || D && "image/svg+xml" !== b.type || "application/pdf" === b.type && c.container.getElementsByTagName("image").length ? f() : c.getSVGForLocalExport(b, e, f, function(a) {-1 < a.indexOf("\x3cforeignObject") && "image/svg+xml" !== b.type ? f() : d.downloadSVGLocal(a, b, f) })
        };
        C(!0, d.getOptions().exporting, { libURL: "https://code.highcharts.com/5.0.7/lib/", buttons: { contextButton: { menuItems: [{ textKey: "printChart", onclick: function() { this.print() } }, { separator: !0 }, { textKey: "downloadPNG", onclick: function() { this.exportChartLocal() } }, { textKey: "downloadJPEG", onclick: function() { this.exportChartLocal({ type: "image/jpeg" }) } }, { textKey: "downloadSVG", onclick: function() { this.exportChartLocal({ type: "image/svg+xml" }) } }, { textKey: "downloadPDF", onclick: function() { this.exportChartLocal({ type: "application/pdf" }) } }] } } })
    })(n)
});