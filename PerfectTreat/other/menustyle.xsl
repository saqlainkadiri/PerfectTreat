<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <html>
            <head>
                <meta charset="utf-8" />
                <title>Basket</title>
                <link href="../css/all.css" rel="stylesheet" type="text/css" media="all" />
                <link href="../css/basket.css" rel="stylesheet" type="text/css" media="all" />
            </head>
            <body>
                <div id="site">
                    <div id="header" role="banner">
                    <h3 id="site_name" class="reset"><a href="login.php">The Perfect Treat</a></h3>
                    <div class="inner">
                        <ul id="quick_links" class="reset menu">
                            <li><a href="prev_orders.php"> View Previous orders    |     </a></li>
                            <li>Find your perfect sweet here....</li>
                        </ul>
                        <form action="../other/search.html" method="post" id="quick_search" role="search">
                            <fieldset>
                                <span class="btn_icon icon_search"><input type="submit" name="submit" value="Search here" /></span>
                            </fieldset>
                        </form>
                        <p id="offer">FREE Shipping on orders over 500/- !</p>

                        <div id="mini_basket">
                            <a href="basket.php" class="basket empty">Basket</a>
                            <a href="logout.php" class="btn checkout">Signout</a>
                        </div>
                    </div>
                </div>
                    <div id="nav_main" role="navigation" class="reset menu pull_out">
                        <h3 class="hidden">Main Navigation</h3>
                        <ul>
                            <li><a href="../php/sweets.php" class="parent"><span>Sweets</span></a></li>
                            <li><a href="../other/menu.xml"><span>Menu</span></a></li>
                            <li><a href="../php/bulk_submit.php"><span>Bulk Orders</span></a></li>
                            <li><a href="../php/aboutus.php"><span>About Us</span></a></li>
                            <li><a href="../php/temp_offer.php?month=10" class="parent"><span>Seasonal Offers</span></a></li>
                        </ul>
                    </div>
                    <div id="content">
                        <table id="basket_table">
                            <tr>
                                <th>Item Number</th>
                                <th>Item Name</th>
                                <th>Price</th>
                            </tr>
                            <xsl:for-each select="foodshop/food">
                                <tr>
                                    <td><xsl:value-of select="id"/></td>
                                    <td><xsl:value-of select="name"/></td>
                                    <td><xsl:value-of select="price"/></td>
                                </tr>
                            </xsl:for-each>
                        </table>
                    </div>
                    <div id="footer">
                    <div class="row clearfix">
                        <h3 class="hidden">Site at a glance</h3>
                        <ul id="nav_seo" class="reset menu hover">
                            <li>
                                <ul id="subscribe">
                                    <li id="rss"><a href="#"><img src="../images/rss_icon.png" width="27" height="27" alt="RSS"></img>Subscribe via RSS</a></li>
                                    <li id="email"><a href="#"><img src="../images/email_icon.png" width="27" height="27" alt="RSS"></img>Get Email Update</a></li>
                                    <li id="twitter"><a href="#"><img src="../images/twitter_icon.png" width="27" height="27" alt="RSS"></img>Follow us on Twitter</a></li>
                                </ul>
                            </li>
                            <li>
                                <ul>
                                    <li><a href="aboutus.php">About us</a></li>
                                    <li><a href="rating.php">Rate us</a></li>
                                </ul>
                            </li>
                            <li>
                                <ul>
                                    <li><a href="#">Mail us your reviews</a></li>
                                    <li><a href="comments.php">Comment your reviews</a></li>
                                    <li><a href="#">Terms &amp; Conditions</a></li>
                                </ul>
                            </li>
                        </ul>
                        <img src="../other/images/logo3.png" width="150" height="150" alt="Hansel and sweet" />
                    </div>
                    <p id="copyright" class="reset pull_out padding" role="contentinfo"> 2017 The Perfect Treat</p>
                </div>
                </div>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>