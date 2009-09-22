/*  Control.Scroller, version 1.1
 *  Copyright (c) 2008, Glenn Nilsson <glenn.nilsson@gmail.com>
 *
 *  Control.Scroller is distributed under the terms of an Creative Commons
 *  Attribution license. In short words, you can use this however you like
 *  as long as you give me and the code credit. Read more at:
 *  <http://creativecommons.org/licenses/by/2.5/>
 *
 *  Requirements: Prototype framework <http://prototype.conio.net/> and
 *  slider.js from <http://wiki.script.aculo.us/scriptaculous/show/Slider>
 *
 *  For details, see: <http://wailqill.com/projects/scroller/>
 *
/*--------------------------------------------------------------------------*/
Control.Scroller = Class.create();
Control.Scroller.scrollers = [];
Control.Scroller.prototype = {
	initialize: function(content, handle, track, options) {
		this.id = "scroller"
		this.content = $(content);
		this.handle = $(handle);
		this.track = $(track);
		
		this.currentValue = 0;

		/* Slider-options */
		this.options = Object.extend({
			axis: 'vertical',
			onChange: function(value)  {
				self.updateView(value);
			},
			onSlide: function(value)  {
				self.updateView(value);
			}
		}, options);
		var self = this;
		/* Scroller-options */
		this.options = Object.extend({
			scrollOnHover: false,
			visibleHeight: this.isVertical() ? 440 : this.content.offsetHeight,
			visibleWidth: this.isVertical() ? this.content.offsetWidth : 300,
			delta: 20,
			autoHide: true,
			interval: 100
		}, this.options);
		
		this.maxValue = this.isVertical() ?
				this.content.offsetHeight - this.options.visibleHeight - this.handle.offsetHeight :
				this.content.offsetWidth - this.options.visibleWidth - this.handle.offsetWidth;
		this.options.range = $R(0, this.maxValue);

		this.buttons = {
			up: $(this.options.up),
			down: $(this.options.down)
		};

    // Ensure that the scroller is needed.
    //var children = $A(this.content.childNodes);
		//var wrapper = this.content.insert({top:new Element("div", { "class": "scroller-content-wrapper" })});
		//children.each(function(child) {
		//  wrapper.insert(child);
		//});
    if ((this.isVertical() && this.content.offsetHeight <= this.options.visibleHeight) || (!this.isVertical() && this.content.offsetWidth <= this.options.visibleWidth)) {
		  if (this.options.autoHide)
		    [this.track, this.handle, this.buttons.up, this.buttons.down].invoke("hide");
		  return;
		}
		
		this.content.style.height = this.options.visibleHeight+"px";
		
		this.eventMouseAction = this.buttonAction.bindAsEventListener(this);
   		$H(this.buttons).values().each(function(button) {
			if (self.options.scrollOnHover) {
				Event.observe(button, "mouseover", self.eventMouseAction);
				Event.observe(button, "mouseout", self.eventMouseAction);
			} else {
				Event.observe(button, "mousedown", self.eventMouseAction);
				Event.observe(button, "mouseup", self.eventMouseAction);
			}
		});
		this.slider = new Control.Slider(this.handle, this.track, this.options);
	},
	isVertical: function() {
		return this.options.axis == 'vertical';
	},
	buttonAction: function(e) {
		this.multiplier = Event.element(e) == this.buttons.up ? -1 : 1;
		switch (e.type) {
			case "mouseover":
			case "mousedown":
				this.scroll();
				var self = this;
				this.timer = setInterval(function() { self.scroll() }, self.options.interval);
				break;
			case "mouseout":
			case "mouseup":
				clearTimeout(this.timer)
				break;
		}
	},
	scroll: function() {
		this.slider.setValue(this.currentValue + this.options.delta * this.multiplier, 0);
	},
	updateView: function(value) {
		this.currentValue = value;
		if (this.options.axis == "vertical") {
			this.content.style.marginTop = (-this.currentValue) + "px";
			this.content.style.height = (this.options.visibleHeight+this.currentValue)+"px";
			this.content.style.clip = 'rect('+value+'px '+this.options.visibleWidth+'px '+(this.options.visibleHeight+this.currentValue)+'px 0px)';
		} else {
			this.content.style.marginLeft = (-this.currentValue) + "px";
			this.content.style.clip = 'rect(0 '+(this.options.visibleHeight+this.currentValue)+'px '+this.options.visibleHeight+'px '+value+'px)';
		}
		(this.options.onScroll || Prototype.emptyFunction)(value, this);
	}
}