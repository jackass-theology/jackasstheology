<?php
?>
<div id="tdb-modal" style="display: none;">
    <router-view></router-view>
</div>

<div id="tdb-es6-not-supported" style="display: none;">
    <div class="tdb-es6-wrap">
        <div class="tdb-es6-content">
            <h1 class="tdb-es6-title">Javascript ES6 not supported</h1>
            <div class="tdb-es6-message">This feature is not available on this browser. Please use a browser that supports javascript ES6:</div>
            <table>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td>Chrome</td>
                    <td>(v49+)</td>
                </tr>
                <tr>
                    <td>Firefox</td>
                    <td>(v57+)</td>
                </tr>
                <tr>
                    <td>Safari</td>
                    <td>(v11+)</td>
                </tr>
                <tr>
                    <td>IE Edge</td>
                    <td>(v16+)</td>
                </tr>
            </table>
        </div>
        <div class="tdb-es6-footer">
            <button class="tdb-btn tdb-es6-close">Close</button>
        </div>
    </div>
</div>