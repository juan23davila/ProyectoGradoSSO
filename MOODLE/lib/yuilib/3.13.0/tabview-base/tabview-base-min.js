/*
YUI 3.13.0 (build 508226d)
Copyright 2013 Yahoo! Inc. All rights reserved.
Licensed under the BSD License.
http://yuilibrary.com/license/
*/

YUI.add("tabview-base",function(e,t){var n=e.ClassNameManager.getClassName,r="tabview",i="tab",s="panel",o="selected",u={},a=".",f=function(){this.init.apply(this,arguments)};f.NAME="tabviewBase",f._classNames={tabview:n(r),tabviewPanel:n(r,s),tabviewList:n(r,"list"),tab:n(i),tabLabel:n(i,"label"),tabPanel:n(i,s),selectedTab:n(i,o),selectedPanel:n(i,s,o)},f._queries={tabview:a+f._classNames.tabview,tabviewList:"> ul",tab:"> ul > li",tabLabel:"> ul > li > a",tabviewPanel:"> div",tabPanel:"> div > div",selectedTab:"> ul > "+a+f._classNames.selectedTab,selectedPanel:"> div "+a+f._classNames.selectedPanel},e.mix(f.prototype,{init:function(t){t=t||u,this._node=t.host||e.one(t.node),this.refresh()},initClassNames:function(t){var n=e.TabviewBase._classNames;e.Object.each(e.TabviewBase._queries,function(e,r){if(n[r]){var i=this.all(e);t!==undefined&&(i=i.item(t)),i&&i.addClass(n[r])}},this._node),this._node.addClass(n.tabview)},_select:function(t){var n=e.TabviewBase._classNames,r=e.TabviewBase._queries,i=this._node,s=i.one(r.selectedTab),o=i.one(r.selectedPanel),u=i.all(r.tab).item(t),a=i.all(r.tabPanel).item(t);s&&s.removeClass(n.selectedTab),o&&o.removeClass(n.selectedPanel),u&&u.addClass(n.selectedTab),a&&a.addClass(n.selectedPanel)},initState:function(){var t=e.TabviewBase._queries,n=this._node,r=n.one(t.selectedTab),i=r?n.all(t.tab).indexOf(r):0;this._select(i)},_scrubTextNodes:function(){this._node.one(e.TabviewBase._queries.tabviewList).get("childNodes").each(function(e){e.get("nodeType")===3&&e.remove()})},refresh:function(){this._scrubTextNodes(),this.initClassNames(),this.initState(),this.initEvents()},tabEventName:"click",initEvents:function(){this._node.delegate(this.tabEventName,this.onTabEvent,e.TabviewBase._queries.tab,this)},onTabEvent:function(t){t.preventDefault(),this._select(this._node.all(e.TabviewBase._queries.tab).indexOf(t.currentTarget))},destroy:function(){this._node.detach(this.tabEventName)}}),e.TabviewBase=f},"3.13.0",{requires:["node-event-delegate","classnamemanager"]});
