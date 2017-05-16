$(function() {		
				
	JQTWEET2 = {
	     
	    // Set twitter hash/user, number of tweets & id/class to append tweets
	    // You need to clear tweet-date.txt before toggle between hash and user
	    // for multiple hashtags, you can separate the hashtag with OR, eg:
	    // hash: '%23jquery OR %23css'			    
	    search: 'EndersGame', //leave this blank if you want to show user's tweet
	    user: 'priyankamalvi18', //username
	    numTweets: 180, //number of tweets
	    appendTo: '#jstwitter',
	    useGridalicious: false,
	    template: '<div class="section" style="background-color:{COLOR}" id="data"><div class="intro" style="padding-top: {PT}%;padding-bottom: 30%; margin-left: -12%; ">\
					{IMG}\
					<blockquote style="margin: 0 0 20px 350px;">{TEXT}<br> <h4 style="text-align: right;padding-right: 0px;"> &mdash; {USER}<a href="{URL}">{AGO}</a></h4></blockquote>\
					</div></div>',
	     
	    // core function of jqtweet
	    // https://dev.twitter.com/docs/using-search
	    loadTweets: function(hashname) {
			
	        var request;
	         
	        // different JSON request {hash|user}
	        if (hashname){
	        	request = {
                q: '%23'+hashname,
                count: JQTWEET2.numTweets,
                api: 'search_tweets'
            }
	        }
	        else if (JQTWEET2.search) {
            request = {
                q: JQTWEET2.search,
                count: JQTWEET2.numTweets,
                api: 'search_tweets'
            }
	        } else {
            request = {
                q: JQTWEET2.user,
                count: JQTWEET2.numTweets,
                api: 'statuses_userTimeline'
            }
	        }

	        $.ajax({
	            url: 'grabtweets.php',
	            type: 'POST',
	            dataType: 'json',
	            data: request,
	            success: function(data, textStatus, xhr) {
		            
		            if (data.httpstatus == 200) {
		            	if (JQTWEET2.search) data = data.statuses;

	                var text, name, img;	         
	                	                
	                try {
	                  // append tweets into page
	                  for (var i = 0; i < JQTWEET2.numTweets; i++) {
	                  
	                    img = '';
	                    url = 'http://twitter.com/' + data[i].user.screen_name + '/status/' + data[i].id_str;
						var pt = 25;
						  var height1=0;
	                    try {
	                      if (data[i].entities['media']) {
	                        img = '<a href="' + url + '" target="_blank"><img src="' + data[i].entities['media'][0].media_url + '" style="position: relative; width:600px; height:450px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"/></a><br><br><br>';
							pt = 10;
	                      }
	                    } catch (e) {  
	                      //no media
	                    }
						  function getRandomColor(val) {
							  var colors = ["#ccf7ff","#ddffcc","rgb(193, 242, 164)","#a9ffd4","#f2d996","#ff979f","#7BAABE","#ccddff"];
							  return colors[val];

						  }

	                    $(JQTWEET2.appendTo).append( JQTWEET2.template.replace('{TEXT}', JQTWEET2.ify.clean(data[i].text) )
	                        .replace('{USER}', data[i].user.screen_name)
	                        .replace('{IMG}', img)                                
	                        .replace('{AGO}', JQTWEET2.timeAgo(data[i].created_at) )
	                        .replace('{URL}', url )
							.replace('{PT}' , pt )
							.replace('{height}',height1)
							.replace('{COLOR}',getRandomColor(i%7))
	                        );
	                  }
                  
                  } catch (e) {
	                  //item is less than item count
                  }
                  
		                if (JQTWEET2.useGridalicious) {
			                //run grid-a-licious
											$(JQTWEET2.appendTo).gridalicious({
												gutter: 13,
												width: 500,
												animate: true
											});	                   
										}                  
	                    
	               } else alert('no data returned');
	             
	            }   
	 
	        });
	 
	    }, 
	     
	         
	    /**
	      * relative time calculator FROM TWITTER
	      * @param {string} twitter date string returned from Twitter API
	      * @return {string} relative time like "2 minutes ago"
	      */
	    timeAgo: function(dateString) {
	        var rightNow = new Date();
	        var then = new Date(dateString);
	         
	        if ($.browser.msie) {
	            // IE can't parse these crazy Ruby dates
	            then = Date.parse(dateString.replace(/( \+)/, ' UTC$1'));
	        }
	 
	        var diff = rightNow - then;
	 
	        var second = 1000,
	        minute = second * 60,
	        hour = minute * 60,
	        day = hour * 24,
	        week = day * 7;
	 
	        if (isNaN(diff) || diff < 0) {
	            return ""; // return blank string if unknown
	        }
	 
	        if (diff < second * 2) {
	            // within 2 seconds
	            return "right now";
	        }
	 
	        if (diff < minute) {
	            return Math.floor(diff / second) + " seconds ago";
	        }
	 
	        if (diff < minute * 2) {
	            return "about 1 minute ago";
	        }
	 
	        if (diff < hour) {
	            return Math.floor(diff / minute) + " minutes ago";
	        }
	 
	        if (diff < hour * 2) {
	            return "about 1 hour ago";
	        }
	 
	        if (diff < day) {
	            return  Math.floor(diff / hour) + " hours ago";
	        }
	 
	        if (diff > day && diff < day * 2) {
	            return "yesterday";
	        }
	 
	        if (diff < day * 365) {
	            return Math.floor(diff / day) + " days ago";
	        }
	 
	        else {
	            return "over a year ago";
	        }
	    }, // timeAgo()
	     
	     
	    /**
	      * The Twitalinkahashifyer!
	      * http://www.dustindiaz.com/basement/ify.html
	      * Eg:
	      * ify.clean('your tweet text');
	      */
	    ify:  {
	      link: function(tweet) {
	        return tweet.replace(/\b(((https*\:\/\/)|www\.)[^\"\']+?)(([!?,.\)]+)?(\s|$))/g, function(link, m1, m2, m3, m4) {
	          var http = m2.match(/w/) ? 'http://' : '';
	          return '<a class="twtr-hyperlink" target="_blank" href="' + http + m1 + '">' + ((m1.length > 25) ? m1.substr(0, 24) + '...' : m1) + '</a>' + m4;
	        });
	      },
	 
	      at: function(tweet) {
	        return tweet.replace(/\B[@＠]([a-zA-Z0-9_]{1,20})/g, function(m, username) {
	          return '<a target="_blank" class="twtr-atreply" href="http://twitter.com/intent/user?screen_name=' + username + '">@' + username + '</a>';
	        });
	      },
	 
	      list: function(tweet) {
	        return tweet.replace(/\B[@＠]([a-zA-Z0-9_]{1,20}\/\w+)/g, function(m, userlist) {
	          return '<a target="_blank" class="twtr-atreply" href="http://twitter.com/' + userlist + '">@' + userlist + '</a>';
	        });
	      },
	 
	      hash: function(tweet) {
	        return tweet.replace(/(^|\s+)#(\w+)/gi, function(m, before, hash) {
	          return before + '<a target="_blank" class="twtr-hashtag" href="http://twitter.com/search?q=%23' + hash + '">#' + hash + '</a>';
	        });
	      },
	 
	      clean: function(tweet) {
	        return this.hash(this.at(this.list(this.link(tweet))));
	      }
	    } // ify
	 
	     
	};		
	
});
