<?php
// Torrenttrader 2.08 test. The CSS fucks with the site on most skins. Fix it later
//
require_once("backend/functions.php");
dbconn(false);
loggedinonly();

stdhead("search");

begin_frame("search");

?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
/* -- import Roboto Font ---------------------------- */
@import "https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic&subset=latin,cyrillic";

/* -- You can use this tables in Bootstrap (v3) projects. -- */
// @import "//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css";


/* -- Box model ------------------------------- */
*,
*:after,
*:before {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

// Material Design typography
// http://codepen.io/zavoloklom/pen/IkaFL
#demo h1 {
  font-size: 2.4rem;
  line-height: 3.2rem;
  letter-spacing: 0;
  font-weight: 300;
  color: #212121;
  text-transform: inherit;
  margin-bottom: 1rem;
  text-align: center;
}
#demo h2 {
  font-size: 1.5rem;
  line-height: 2.8rem;
  letter-spacing: 0.01rem;
  font-weight: 400;
  color: #212121;
  text-align: center;
}

// Material Design shadows
// 
.shadow-z-1 {
  -webkit-box-shadow: 0 1px 3px 0 rgba(0,0,0,.12),
                      0 1px 2px 0 rgba(0,0,0,.24);
  -moz-box-shadow:    0 1px 3px 0 rgba(0,0,0,.12),
                      0 1px 2px 0 rgba(0,0,0,.24);
  box-shadow:         0 1px 3px 0 rgba(0,0,0,.12),
                      0 1px 2px 0 rgba(0,0,0,.24);
}


/* -- Material Design Table style -------------- */

// Variables
// ---------------------
@table-header-font-weight:      400;
@table-header-font-color:       #757575;

@table-cell-padding:            1.6rem;
@table-condensed-cell-padding:  @table-cell-padding/2;


@table-bg:                      #fff;
@table-bg-accent:               #f5f5f5;
@table-bg-hover:                rgba(0,0,0,.12);
@table-bg-active:               @table-bg-hover;
@table-border-color:            #e0e0e0;



// Mixins
// -----------------
.transition(@transition) {
  -webkit-transition: @transition;
       -o-transition: @transition;
          transition: @transition;
}

// Tables
//
// -----------------

// Baseline styles
.table {
  width: 100%;
  max-width: 100%;
  margin-bottom: 2rem;
  background-color: @table-bg;
  > thead,
  > tbody,
  > tfoot {
    > tr {
      .transition(all .3s ease);
      > th,
      > td {
        text-align: left;
        padding: @table-cell-padding;
        vertical-align: top;
        border-top: 0;
        .transition(all .3s ease);
      }
    }
  }
  > thead > tr > th {
    font-weight: @table-header-font-weight;
    color: @table-header-font-color;
    vertical-align: bottom;
    border-bottom: 1px solid rgba(0,0,0,.12);
  }
  > caption + thead,
  > colgroup + thead,
  > thead:first-child {
    > tr:first-child {
      > th,
      > td {
        border-top: 0;
      }
    }
  }
  > tbody + tbody {
    border-top: 1px solid rgba(0,0,0,.12);
  }

  // Nesting
  .table {
    background-color: @table-bg;
  }

  // Remove border
  .no-border {
    border: 0;
  }
}

// Condensed table w/ half padding
.table-condensed {
  > thead,
  > tbody,
  > tfoot {
    > tr {
      > th,
      > td {
        padding: @table-condensed-cell-padding;
      }
    }
  }
}


// Bordered version
//
// Add horizontal borders between columns.
.table-bordered {
  border: 0;
  > thead,
  > tbody,
  > tfoot {
    > tr {
      > th,
      > td {
        border: 0;
        border-bottom: 1px solid @table-border-color;
      }
    }
  }
  > thead > tr {
    > th,
    > td {
      border-bottom-width: 2px;
    }
  }
}


// Zebra-striping
//
// Default zebra-stripe styles (alternating gray and transparent backgrounds)
.table-striped {
  > tbody > tr:nth-child(odd) {
    > td,
    > th {
      background-color: @table-bg-accent;
    }
  }
}

// Hover effect
//
.table-hover {
  > tbody > tr:hover {
    > td,
    > th {
      background-color: @table-bg-hover;
    }
  }
}

// Responsive tables (vertical)
//
// Wrap your tables in `.table-responsive-vertical` and we'll make them mobile friendly
// by vertical table-cell display. Only applies <768px. Everything above that will display normally.
// For correct display you must add 'data-title' to each 'td'
.table-responsive-vertical {

  @media screen and (max-width: 768px) {

    // Tighten up spacing
    > .table {
      margin-bottom: 0;
      background-color: transparent;
      > thead,
      > tfoot {
        display: none;
      }

      > tbody {
        display: block;

        > tr {
          display: block;
          border: 1px solid @table-border-color;
          border-radius: 2px;
          margin-bottom: @table-cell-padding;

          > td {
            background-color: @table-bg;
            display: block;
            vertical-align: middle;
            text-align: right;
          }
          > td[data-title]:before {
            content: attr(data-title);
            float: left;
            font-size: inherit;
            font-weight: @table-header-font-weight;
            color: @table-header-font-color;
          }
        }
      }
    }
    
    // Special overrides for shadows
    &.shadow-z-1 {
      -webkit-box-shadow: none;
      -moz-box-shadow: none;
      box-shadow: none;
      > .table > tbody > tr {
        border: none;
        .shadow-z-1();
      }
    }

    // Special overrides for the bordered tables
    > .table-bordered {
      border: 0;

      // Nuke the appropriate borders so that the parent can handle them
      > tbody {
        > tr {
          > td {
            border: 0;
            border-bottom: 1px solid @table-border-color;
          }
          > td:last-child {
            border-bottom: 0;
          }
        }
      }
    }

    // Special overrides for the striped tables
    > .table-striped {
      > tbody > tr > td,
      > tbody > tr:nth-child(odd) {
          background-color: @table-bg;
      }
      > tbody > tr > td:nth-child(odd) {
          background-color: @table-bg-accent;
      }
    }

    // Special overrides for hover tables
    > .table-hover {
      > tbody {
        > tr:hover > td,
        > tr:hover {
          background-color: @table-bg;
        }
        > tr > td:hover {
          background-color: @table-bg-hover;
        }
      }
    }
  }
}


// CSS/LESS Color variations
//
// --------------------------------


.table-striped.table-mc-red > tbody > tr:nth-child(odd) > td,
.table-striped.table-mc-red > tbody > tr:nth-child(odd) > th {
    background-color: #fde0dc;
}
.table-hover.table-mc-red > tbody > tr:hover > td,
.table-hover.table-mc-red > tbody > tr:hover > th {
    background-color: #f9bdbb;
}
@media screen and (max-width: 767px) {
    .table-responsive-vertical .table-striped.table-mc-red > tbody > tr > td,
    .table-responsive-vertical .table-striped.table-mc-red > tbody > tr:nth-child(odd) {
        background-color: @table-bg;
    }
    .table-responsive-vertical .table-striped.table-mc-red > tbody > tr > td:nth-child(odd) {
        background-color: #fde0dc;
    }
    .table-responsive-vertical .table-hover.table-mc-red > tbody > tr:hover > td,
    .table-responsive-vertical .table-hover.table-mc-red > tbody > tr:hover {
        background-color: @table-bg;
    }
    .table-responsive-vertical .table-hover.table-mc-red > tbody > tr > td:hover {
        background-color: #f9bdbb;
    }
}
.table-striped.table-mc-pink > tbody > tr:nth-child(odd) > td,
.table-striped.table-mc-pink > tbody > tr:nth-child(odd) > th {
    background-color: #fce4ec;
}
.table-hover.table-mc-pink > tbody > tr:hover > td,
.table-hover.table-mc-pink > tbody > tr:hover > th {
    background-color: #f8bbd0;
}
@media screen and (max-width: 767px) {
    .table-responsive-vertical .table-striped.table-mc-pink > tbody > tr > td,
    .table-responsive-vertical .table-striped.table-mc-pink > tbody > tr:nth-child(odd) {
        background-color: @table-bg;
    }
    .table-responsive-vertical .table-striped.table-mc-pink > tbody > tr > td:nth-child(odd) {
        background-color: #fce4ec;
    }
    .table-responsive-vertical .table-hover.table-mc-pink > tbody > tr:hover > td,
    .table-responsive-vertical .table-hover.table-mc-pink > tbody > tr:hover {
        background-color: @table-bg;
    }
    .table-responsive-vertical .table-hover.table-mc-pink > tbody > tr > td:hover {
        background-color: #f8bbd0;
    }
}
.table-striped.table-mc-purple > tbody > tr:nth-child(odd) > td,
.table-striped.table-mc-purple > tbody > tr:nth-child(odd) > th {
    background-color: #f3e5f5;
}
.table-hover.table-mc-purple > tbody > tr:hover > td,
.table-hover.table-mc-purple > tbody > tr:hover > th {
    background-color: #e1bee7;
}
@media screen and (max-width: 767px) {
    .table-responsive-vertical .table-striped.table-mc-purple > tbody > tr > td,
    .table-responsive-vertical .table-striped.table-mc-purple > tbody > tr:nth-child(odd) {
        background-color: @table-bg;
    }
    .table-responsive-vertical .table-striped.table-mc-purple > tbody > tr > td:nth-child(odd) {
        background-color: #f3e5f5;
    }
    .table-responsive-vertical .table-hover.table-mc-purple > tbody > tr:hover > td,
    .table-responsive-vertical .table-hover.table-mc-purple > tbody > tr:hover {
        background-color: @table-bg;
    }
    .table-responsive-vertical .table-hover.table-mc-purple > tbody > tr > td:hover {
        background-color: #e1bee7;
    }
}
.table-striped.table-mc-deep-purple > tbody > tr:nth-child(odd) > td,
.table-striped.table-mc-deep-purple > tbody > tr:nth-child(odd) > th {
    background-color: #ede7f6;
}
.table-hover.table-mc-deep-purple > tbody > tr:hover > td,
.table-hover.table-mc-deep-purple > tbody > tr:hover > th {
    background-color: #d1c4e9;
}
@media screen and (max-width: 767px) {
    .table-responsive-vertical .table-striped.table-mc-deep-purple > tbody > tr > td,
    .table-responsive-vertical .table-striped.table-mc-deep-purple > tbody > tr:nth-child(odd) {
        background-color: @table-bg;
    }
    .table-responsive-vertical .table-striped.table-mc-deep-purple > tbody > tr > td:nth-child(odd) {
        background-color: #ede7f6;
    }
    .table-responsive-vertical .table-hover.table-mc-deep-purple > tbody > tr:hover > td,
    .table-responsive-vertical .table-hover.table-mc-deep-purple > tbody > tr:hover {
        background-color: @table-bg;
    }
    .table-responsive-vertical .table-hover.table-mc-deep-purple > tbody > tr > td:hover {
        background-color: #d1c4e9;
    }
}
.table-striped.table-mc-indigo > tbody > tr:nth-child(odd) > td,
.table-striped.table-mc-indigo > tbody > tr:nth-child(odd) > th {
    background-color: #e8eaf6;
}
.table-hover.table-mc-indigo > tbody > tr:hover > td,
.table-hover.table-mc-indigo > tbody > tr:hover > th {
    background-color: #c5cae9;
}
@media screen and (max-width: 767px) {
    .table-responsive-vertical .table-striped.table-mc-indigo > tbody > tr > td,
    .table-responsive-vertical .table-striped.table-mc-indigo > tbody > tr:nth-child(odd) {
        background-color: @table-bg;
    }
    .table-responsive-vertical .table-striped.table-mc-indigo > tbody > tr > td:nth-child(odd) {
        background-color: #e8eaf6;
    }
    .table-responsive-vertical .table-hover.table-mc-indigo > tbody > tr:hover > td,
    .table-responsive-vertical .table-hover.table-mc-indigo > tbody > tr:hover {
        background-color: @table-bg;
    }
    .table-responsive-vertical .table-hover.table-mc-indigo > tbody > tr > td:hover {
        background-color: #c5cae9;
    }
}
.table-striped.table-mc-blue > tbody > tr:nth-child(odd) > td,
.table-striped.table-mc-blue > tbody > tr:nth-child(odd) > th {
    background-color: #e7e9fd;
}
.table-hover.table-mc-blue > tbody > tr:hover > td,
.table-hover.table-mc-blue > tbody > tr:hover > th {
    background-color: #d0d9ff;
}
@media screen and (max-width: 767px) {
    .table-responsive-vertical .table-striped.table-mc-blue > tbody > tr > td,
    .table-responsive-vertical .table-striped.table-mc-blue > tbody > tr:nth-child(odd) {
        background-color: @table-bg;
    }
    .table-responsive-vertical .table-striped.table-mc-blue > tbody > tr > td:nth-child(odd) {
        background-color: #e7e9fd;
    }
    .table-responsive-vertical .table-hover.table-mc-blue > tbody > tr:hover > td,
    .table-responsive-vertical .table-hover.table-mc-blue > tbody > tr:hover {
        background-color: @table-bg;
    }
    .table-responsive-vertical .table-hover.table-mc-blue > tbody > tr > td:hover {
        background-color: #d0d9ff;
    }
}
.table-striped.table-mc-light-blue > tbody > tr:nth-child(odd) > td,
.table-striped.table-mc-light-blue > tbody > tr:nth-child(odd) > th {
    background-color: #e1f5fe;
}
.table-hover.table-mc-light-blue > tbody > tr:hover > td,
.table-hover.table-mc-light-blue > tbody > tr:hover > th {
    background-color: #b3e5fc;
}
@media screen and (max-width: 767px) {
    .table-responsive-vertical .table-striped.table-mc-light-blue > tbody > tr > td,
    .table-responsive-vertical .table-striped.table-mc-light-blue > tbody > tr:nth-child(odd) {
        background-color: @table-bg;
    }
    .table-responsive-vertical .table-striped.table-mc-light-blue > tbody > tr > td:nth-child(odd) {
        background-color: #e1f5fe;
    }
    .table-responsive-vertical .table-hover.table-mc-light-blue > tbody > tr:hover > td,
    .table-responsive-vertical .table-hover.table-mc-light-blue > tbody > tr:hover {
        background-color: @table-bg;
    }
    .table-responsive-vertical .table-hover.table-mc-light-blue > tbody > tr > td:hover {
        background-color: #b3e5fc;
    }
}
.table-striped.table-mc-cyan > tbody > tr:nth-child(odd) > td,
.table-striped.table-mc-cyan > tbody > tr:nth-child(odd) > th {
    background-color: #e0f7fa;
}
.table-hover.table-mc-cyan > tbody > tr:hover > td,
.table-hover.table-mc-cyan > tbody > tr:hover > th {
    background-color: #b2ebf2;
}
@media screen and (max-width: 767px) {
    .table-responsive-vertical .table-striped.table-mc-cyan > tbody > tr > td,
    .table-responsive-vertical .table-striped.table-mc-cyan > tbody > tr:nth-child(odd) {
        background-color: @table-bg;
    }
    .table-responsive-vertical .table-striped.table-mc-cyan > tbody > tr > td:nth-child(odd) {
        background-color: #e0f7fa;
    }
    .table-responsive-vertical .table-hover.table-mc-cyan > tbody > tr:hover > td,
    .table-responsive-vertical .table-hover.table-mc-cyan > tbody > tr:hover {
        background-color: @table-bg;
    }
    .table-responsive-vertical .table-hover.table-mc-cyan > tbody > tr > td:hover {
        background-color: #b2ebf2;
    }
}
.table-striped.table-mc-teal > tbody > tr:nth-child(odd) > td,
.table-striped.table-mc-teal > tbody > tr:nth-child(odd) > th {
    background-color: #e0f2f1;
}
.table-hover.table-mc-teal > tbody > tr:hover > td,
.table-hover.table-mc-teal > tbody > tr:hover > th {
    background-color: #b2dfdb;
}
@media screen and (max-width: 767px) {
    .table-responsive-vertical .table-striped.table-mc-teal > tbody > tr > td,
    .table-responsive-vertical .table-striped.table-mc-teal > tbody > tr:nth-child(odd) {
        background-color: @table-bg;
    }
    .table-responsive-vertical .table-striped.table-mc-teal > tbody > tr > td:nth-child(odd) {
        background-color: #e0f2f1;
    }
    .table-responsive-vertical .table-hover.table-mc-teal > tbody > tr:hover > td,
    .table-responsive-vertical .table-hover.table-mc-teal > tbody > tr:hover {
        background-color: @table-bg;
    }
    .table-responsive-vertical .table-hover.table-mc-teal > tbody > tr > td:hover {
        background-color: #b2dfdb;
    }
}
.table-striped.table-mc-green > tbody > tr:nth-child(odd) > td,
.table-striped.table-mc-green > tbody > tr:nth-child(odd) > th {
    background-color: #d0f8ce;
}
.table-hover.table-mc-green > tbody > tr:hover > td,
.table-hover.table-mc-green > tbody > tr:hover > th {
    background-color: #a3e9a4;
}
@media screen and (max-width: 767px) {
    .table-responsive-vertical .table-striped.table-mc-green > tbody > tr > td,
    .table-responsive-vertical .table-striped.table-mc-green > tbody > tr:nth-child(odd) {
        background-color: @table-bg;
    }
    .table-responsive-vertical .table-striped.table-mc-green > tbody > tr > td:nth-child(odd) {
        background-color: #d0f8ce;
    }
    .table-responsive-vertical .table-hover.table-mc-green > tbody > tr:hover > td,
    .table-responsive-vertical .table-hover.table-mc-green > tbody > tr:hover {
        background-color: @table-bg;
    }
    .table-responsive-vertical .table-hover.table-mc-green > tbody > tr > td:hover {
        background-color: #a3e9a4;
    }
}
.table-striped.table-mc-light-green > tbody > tr:nth-child(odd) > td,
.table-striped.table-mc-light-green > tbody > tr:nth-child(odd) > th {
    background-color: #f1f8e9;
}
.table-hover.table-mc-light-green > tbody > tr:hover > td,
.table-hover.table-mc-light-green > tbody > tr:hover > th {
    background-color: #dcedc8;
}
@media screen and (max-width: 767px) {
    .table-responsive-vertical .table-striped.table-mc-light-green > tbody > tr > td,
    .table-responsive-vertical .table-striped.table-mc-light-green > tbody > tr:nth-child(odd) {
        background-color: @table-bg;
    }
    .table-responsive-vertical .table-striped.table-mc-light-green > tbody > tr > td:nth-child(odd) {
        background-color: #f1f8e9;
    }
    .table-responsive-vertical .table-hover.table-mc-light-green > tbody > tr:hover > td,
    .table-responsive-vertical .table-hover.table-mc-light-green > tbody > tr:hover {
        background-color: @table-bg;
    }
    .table-responsive-vertical .table-hover.table-mc-light-green > tbody > tr > td:hover {
        background-color: #dcedc8;
    }
}
.table-striped.table-mc-lime > tbody > tr:nth-child(odd) > td,
.table-striped.table-mc-lime > tbody > tr:nth-child(odd) > th {
    background-color: #f9fbe7;
}
.table-hover.table-mc-lime > tbody > tr:hover > td,
.table-hover.table-mc-lime > tbody > tr:hover > th {
    background-color: #f0f4c3;
}
@media screen and (max-width: 767px) {
    .table-responsive-vertical .table-striped.table-mc-lime > tbody > tr > td,
    .table-responsive-vertical .table-striped.table-mc-lime > tbody > tr:nth-child(odd) {
        background-color: @table-bg;
    }
    .table-responsive-vertical .table-striped.table-mc-lime > tbody > tr > td:nth-child(odd) {
        background-color: #f9fbe7;
    }
    .table-responsive-vertical .table-hover.table-mc-lime > tbody > tr:hover > td,
    .table-responsive-vertical .table-hover.table-mc-lime > tbody > tr:hover {
        background-color: @table-bg;
    }
    .table-responsive-vertical .table-hover.table-mc-lime > tbody > tr > td:hover {
        background-color: #f0f4c3;
    }
}
.table-striped.table-mc-yellow > tbody > tr:nth-child(odd) > td,
.table-striped.table-mc-yellow > tbody > tr:nth-child(odd) > th {
    background-color: #fffde7;
}
.table-hover.table-mc-yellow > tbody > tr:hover > td,
.table-hover.table-mc-yellow > tbody > tr:hover > th {
    background-color: #fff9c4;
}
@media screen and (max-width: 767px) {
    .table-responsive-vertical .table-striped.table-mc-yellow > tbody > tr > td,
    .table-responsive-vertical .table-striped.table-mc-yellow > tbody > tr:nth-child(odd) {
        background-color: @table-bg;
    }
    .table-responsive-vertical .table-striped.table-mc-yellow > tbody > tr > td:nth-child(odd) {
        background-color: #fffde7;
    }
    .table-responsive-vertical .table-hover.table-mc-yellow > tbody > tr:hover > td,
    .table-responsive-vertical .table-hover.table-mc-yellow > tbody > tr:hover {
        background-color: @table-bg;
    }
    .table-responsive-vertical .table-hover.table-mc-yellow > tbody > tr > td:hover {
        background-color: #fff9c4;
    }
}
.table-striped.table-mc-amber > tbody > tr:nth-child(odd) > td,
.table-striped.table-mc-amber > tbody > tr:nth-child(odd) > th {
    background-color: #fff8e1;
}
.table-hover.table-mc-amber > tbody > tr:hover > td,
.table-hover.table-mc-amber > tbody > tr:hover > th {
    background-color: #ffecb3;
}
@media screen and (max-width: 767px) {
    .table-responsive-vertical .table-striped.table-mc-amber > tbody > tr > td,
    .table-responsive-vertical .table-striped.table-mc-amber > tbody > tr:nth-child(odd) {
        background-color: @table-bg;
    }
    .table-responsive-vertical .table-striped.table-mc-amber > tbody > tr > td:nth-child(odd) {
        background-color: #fff8e1;
    }
    .table-responsive-vertical .table-hover.table-mc-amber > tbody > tr:hover > td,
    .table-responsive-vertical .table-hover.table-mc-amber > tbody > tr:hover {
        background-color: @table-bg;
    }
    .table-responsive-vertical .table-hover.table-mc-amber > tbody > tr > td:hover {
        background-color: #ffecb3;
    }
}
.table-striped.table-mc-orange > tbody > tr:nth-child(odd) > td,
.table-striped.table-mc-orange > tbody > tr:nth-child(odd) > th {
    background-color: #fff3e0;
}
.table-hover.table-mc-orange > tbody > tr:hover > td,
.table-hover.table-mc-orange > tbody > tr:hover > th {
    background-color: #ffe0b2;
}
@media screen and (max-width: 767px) {
    .table-responsive-vertical .table-striped.table-mc-orange > tbody > tr > td,
    .table-responsive-vertical .table-striped.table-mc-orange > tbody > tr:nth-child(odd) {
        background-color: @table-bg;
    }
    .table-responsive-vertical .table-striped.table-mc-orange > tbody > tr > td:nth-child(odd) {
        background-color: #fff3e0;
    }
    .table-responsive-vertical .table-hover.table-mc-orange > tbody > tr:hover > td,
    .table-responsive-vertical .table-hover.table-mc-orange > tbody > tr:hover {
        background-color: @table-bg;
    }
    .table-responsive-vertical .table-hover.table-mc-orange > tbody > tr > td:hover {
        background-color: #ffe0b2;
    }
}
.table-striped.table-mc-deep-orange > tbody > tr:nth-child(odd) > td,
.table-striped.table-mc-deep-orange > tbody > tr:nth-child(odd) > th {
    background-color: #fbe9e7;
}
.table-hover.table-mc-deep-orange > tbody > tr:hover > td,
.table-hover.table-mc-deep-orange > tbody > tr:hover > th {
    background-color: #ffccbc;
}
@media screen and (max-width: 767px) {
    .table-responsive-vertical .table-striped.table-mc-deep-orange > tbody > tr > td,
    .table-responsive-vertical .table-striped.table-mc-deep-orange > tbody > tr:nth-child(odd) {
        background-color: @table-bg;
    }
    .table-responsive-vertical .table-striped.table-mc-deep-orange > tbody > tr > td:nth-child(odd) {
        background-color: #fbe9e7;
    }
    .table-responsive-vertical .table-hover.table-mc-deep-orange > tbody > tr:hover > td,
    .table-responsive-vertical .table-hover.table-mc-deep-orange > tbody > tr:hover {
        background-color: @table-bg;
    }
    .table-responsive-vertical .table-hover.table-mc-deep-orange > tbody > tr > td:hover {
        background-color: #ffccbc;
    }
}

body2 {
  background: #eee;
  font: 12px Lucida sans, Arial, Helvetica, sans-serif;
	color: #333;
	text-align: center;
}

a {
	color: #2A679F;
}
/*========*/

.form-wrapper {
	background-color: #f6f6f6;
	background-image: -webkit-gradient(linear, left top, left bottom, from(#f6f6f6), to(#eae8e8));
	background-image: -webkit-linear-gradient(top, #f6f6f6, #eae8e8);
	background-image: -moz-linear-gradient(top, #f6f6f6, #eae8e8);
	background-image: -ms-linear-gradient(top, #f6f6f6, #eae8e8);
	background-image: -o-linear-gradient(top, #f6f6f6, #eae8e8);
	background-image: linear-gradient(top, #f6f6f6, #eae8e8);
	border-color: #dedede #bababa #aaa #bababa;
	border-style: solid;
	border-width: 1px;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
	-webkit-box-shadow: 0 3px 3px rgba(255,255,255,.1), 0 3px 0 #bbb, 0 4px 0 #aaa, 0 5px 5px #444;
	-moz-box-shadow: 0 3px 3px rgba(255,255,255,.1), 0 3px 0 #bbb, 0 4px 0 #aaa, 0 5px 5px #444;
	box-shadow: 0 3px 3px rgba(255,255,255,.1), 0 3px 0 #bbb, 0 4px 0 #aaa, 0 5px 5px #444;
	margin: 100px auto;
	overflow: hidden;
	padding: 8px;
	width: 450px;
}

.form-wrapper #search {
	border: 1px solid #CCC;
	-webkit-box-shadow: 0 1px 1px #ddd inset, 0 1px 0 #FFF;
	-moz-box-shadow: 0 1px 1px #ddd inset, 0 1px 0 #FFF;
	box-shadow: 0 1px 1px #ddd inset, 0 1px 0 #FFF;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
  color: #999;
	float: left;
	font: 16px Lucida Sans, Trebuchet MS, Tahoma, sans-serif;
	height: 20px;
	padding: 10px;
	width: 320px;
}



.form-wrapper #yel {
	height:30px;
 width:80px;
border-radius:2px;
}

.form-wrapper #search:focus {
	border-color: #aaa;
	-webkit-box-shadow: 0 1px 1px #bbb inset;
	-moz-box-shadow: 0 1px 1px #bbb inset;
	box-shadow: 0 1px 1px #bbb inset;
	outline: 0;
}

.form-wrapper #search:-moz-placeholder,
.form-wrapper #search:-ms-input-placeholder,
.form-wrapper #search::-webkit-input-placeholder {
	color: #999;
	font-weight: normal;
}

.form-wrapper #submit {
	background-color: #0483a0;
	background-image: -webkit-gradient(linear, left top, left bottom, from(#31b2c3), to(#0483a0));
	background-image: -webkit-linear-gradient(top, #31b2c3, #0483a0);
	background-image: -moz-linear-gradient(top, #31b2c3, #0483a0);
	background-image: -ms-linear-gradient(top, #31b2c3, #0483a0);
	background-image: -o-linear-gradient(top, #31b2c3, #0483a0);
	background-image: linear-gradient(top, #31b2c3, #0483a0);
	border: 1px solid #00748f;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	-webkit-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset, 0 1px 0 #FFF;
	-moz-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset, 0 1px 0 #FFF;
	box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset, 0 1px 0 #FFF;
	color: #fafafa;
	cursor: pointer;
	height: 42px;
	float: right;
	font: 15px Arial, Helvetica;
	padding: 0;
	text-transform: uppercase;
	text-shadow: 0 1px 0 rgba(0, 0 ,0, .3);
	width: 100px;
}

.form-wrapper #submit:hover,
.form-wrapper #submit:focus {
	background-color: #31b2c3;
	background-image: -webkit-gradient(linear, left top, left bottom, from(#0483a0), to(#31b2c3));
	background-image: -webkit-linear-gradient(top, #0483a0, #31b2c3);
	background-image: -moz-linear-gradient(top, #0483a0, #31b2c3);
	background-image: -ms-linear-gradient(top, #0483a0, #31b2c3);
	background-image: -o-linear-gradient(top, #0483a0, #31b2c3);
	background-image: linear-gradient(top, #0483a0, #31b2c3);
}

.form-wrapper #submit:active {
	-webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
	-moz-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
	box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
	outline: 0;
}

.form-wrapper #submit::-moz-focus-inner {
	border: 0;
}

</style>
</head>
<body>
<form class="form-wrapper" method="get" action="">
    <input type="text" name="s" id="search" placeholder="Search for..." required><select name="se" id="yel" >  
  <option selected  value="3">Server 1</option>
  <option value="4">Server 2</option>
 <option value="6">Server 3</option>
 <option value="8">Server 4</option>
</select><br>
    <input type="submit" value="go" id="submit">
</form>
<?php
function loss($url){
$che = curl_init();
        curl_setopt($che, CURLOPT_URL, $url);
        curl_setopt($che, CURLOPT_POST, 0);
      // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	  // curl_setopt($che, CURLOPT_SSL_VERIFYHOST, 0);
      //curl_setopt($che, CURLOPT_SSL_VERIFYPEER, 0);	
		curl_setopt($che, CURLOPT_RETURNTRANSFER, 1);

        return curl_exec($che);
		
		}
if(isset($_GET['s'])){
		$text = $_GET['s'];
$se = $_GET['se'];
$trimmed = trim($text); // Trims both ends
$text = str_replace(' ', '+', $trimmed);
//Working providers 3 , 4,6,8
		$url = 'http://www.bradeliade.com/tse/v3.6/simplehtmldom_1_5/my_parsers/scraping/my_scraper.php?query='.$text.'&sort=0&category=0%27&page=1&adult=0&key=abcd&concurrent=0&rbg_token=f123l89gpy&provider_ids%5B%5D='.$se.'';
		$dt = loss($url);
		$jd= json_decode($dt,1);
                $c = count($jd['results']);
              $url = 'http://www.bradeliade.com/tse/v3.6/simplehtmldom_1_5/my_parsers/scraping/my_scraper.php?query='.$text.'&sort=0&category=0%27&page=2&adult=0&key=abcd&concurrent=0&rbg_token=f123l89gpy&provider_ids%5B%5D='.$se.'';
		$dt2 = loss($url);
		$jd2= json_decode($dt,1);
                $c2 = count($jd['results']);

$url = 'http://www.bradeliade.com/tse/v3.6/simplehtmldom_1_5/my_parsers/scraping/my_scraper.php?query='.$text.'&sort=0&category=0%27&page=3&adult=0&key=abcd&concurrent=0&rbg_token=f123l89gpy&provider_ids%5B%5D='.$se.'';
		$dt3 = loss($url);
		$jd3= json_decode($dt,1);
                $c3 = count($jd['results']);

$url = 'http://www.bradeliade.com/tse/v3.6/simplehtmldom_1_5/my_parsers/scraping/my_scraper.php?query='.$text.'&sort=0&category=0%27&page=3&adult=0&key=abcd&concurrent=0&rbg_token=f123l89gpy&provider_ids%5B%5D='.$se.'';
		$dt4 = loss($url);
		$jd4= json_decode($dt,1);
                $c4 = count($jd['results']);
//echo $dt;
echo '<div id="demo">
  
  <div class="table-responsive-vertical shadow-z-1">
   <table id="table" class="table table-hover table-mc-light-blue">
      <thead>
        <tr>
          <th>Name</th>
          <th>Magnet</th>
          <th>Seeds</th>
          <th>Leechs</th>
        <th>Size</th>
        </tr>
      </thead>
      <tbody>';
for($i=0;$i<$c;$i++){
$title = $jd['results'][$i]['title'];
$size = $jd['results'][$i]['size'];
$magnet = $jd['results'][$i]['magnet'];
$seed = $jd['results'][$i]['seeds'];
$leeches = $jd['results'][$i]['leechs'];
echo ' <tr>
          <td data-title="Name"><hr>'.$title.'</td>
          <td data-title="Link"><hr>
            <a href="'.$magnet.'" target="_blank">Magnet</a>
          </td>
          <td data-title="Status" align="center"><hr>'.$seed.'</td>
          <td data-title="ID" align="center"><hr>'.$leeches.'</td>
          <td data-title="Status" align="right"><hr>'.$size.'</td>
        </tr>';
}
for($i=0;$i<$c3;$i++){
$title = $jd3['results'][$i]['title'];
$size = $jd3['results'][$i]['size'];
$magnet = $jd3['results'][$i]['magnet'];
$seed = $jd3['results'][$i]['seeds'];
$leeches = $jd3['results'][$i]['leechs'];
echo ' <tr>
          <td data-title="Name"><hr>'.$title.'</td>
          <td data-title="Link"><hr>
            <a href="'.$magnet.'" target="_blank">Magnet</a>
          </td>
          <td data-title="Status" align="center"><hr>'.$seed.'</td>
          <td data-title="ID" align="center"><hr>'.$leeches.'</td>
          <td data-title="Status" align="right"><hr>'.$size.'</td>
		  </tr>';
}
for($i=0;$i<$c2;$i++){
$title = $jd2['results'][$i]['title'];
$size = $jd2['results'][$i]['size'];
$magnet = $jd2['results'][$i]['magnet'];
$seed = $jd2['results'][$i]['seeds'];
$leeches = $jd2['results'][$i]['leechs'];
echo ' <tr>
          <td data-title="Name"><hr>'.$title.'</td>
          <td data-title="Link"><hr>
            <a href="'.$magnet.'" target="_blank">Magnet</a>
          </td>
          <td data-title="Status" align="center"><hr>'.$seed.'</td>
          <td data-title="ID" align="center"><hr>'.$leeches.'</td>
          <td data-title="Status" align="right"><hr>'.$size.'</td>
		  </tr>';
}
for($i=0;$i<$c4;$i++){
$title = $jd4['results'][$i]['title'];
$size = $jd4['results'][$i]['size'];
$magnet = $jd4['results'][$i]['magnet'];
$seed = $jd4['results'][$i]['seeds'];
$leeches = $jd4['results'][$i]['leechs'];
echo ' <tr>
          <td data-title="Name"><hr>'.$title.'</td>
          <td data-title="Link"><hr>
            <a href="'.$magnet.'" target="_blank">Magnet</a>
          </td>
          <td data-title="Status" align="center"><hr>'.$seed.'</td>
          <td data-title="ID" align="center"><hr>'.$leeches.'</td>
          <td data-title="Status" align="right"><hr>'.$size.'</td>
		  </tr>';
}


echo '</tbody>
    </table>
  </div>
  
  ';

		}
	end_frame();
stdfoot();
		?>