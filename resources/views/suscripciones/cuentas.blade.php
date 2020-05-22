<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <title>Netflix</title>

        <link
            type="text/css"
            rel="stylesheet"
            href="/personalization/cl2/freeform/WebsiteDetect?source=wwwhead&amp;fetchType=css&amp;modalView=signupSimplicity-planSelectionWithContext"
        />

        <script type="text/javascript">
            (function() {
                var request = new XMLHttpRequest();
                request.open(
                    "GET",
                    "/personalization/cl2/freeform/WebsiteDetect?source=wwwhead&fetchType=js&modalView=signupSimplicity-planSelectionWithContext",
                    true
                );
                request.send();
            })();
        </script>

        <link
            type="text/css"
            rel="stylesheet"
            href="https://codex.nflxext.com/%5E3.0.0/truthBundle/webui/0.0.1-shakti-css-v1b8c742f/css/css/less%7Ccore%7Cerror-page.less/1/tDvL3ruH9CIK/none/true/none"
        />
        <link
            type="text/css"
            rel="stylesheet"
            href="https://codex.nflxext.com/%5E3.0.0/truthBundle/webui/0.0.1-shakti-css-v1b8c742f/css/css/less%7Cpages%7Csignup%7Csimplicity%7Csimplicity.less/1/tDvL3ruH9CIK/none/true/none"
        />
    </head>

    <body>
        <div id="appMountPoint">
            <div class="netflix-sans-font-loaded">
                <div
                    class="basicLayout modernInApp signupSimplicity-planSelection simplicity"
                    lang="en-US"
                    dir="ltr"
                >
                    <div class="nfHeader noBorderHeader signupBasicHeader">
                        <img
                            src="{{url('/image/logo.png')}}"
                            class="img-fluid"
                            alt="Bookflix"
                            width="50%"
                        />

                        <a
                            href="/signout"
                            class="authLinks signupBasicHeader"
                            data-uia="header-signout-link"
                        >
                            Sign Out
                        </a>
                    </div>
                    <div class="simpleContainer" data-transitioned-child="true">
                        <div
                            class="centerContainer narrowCenterContainer"
                            style="display: block; transform: none; opacity: 1; transition-duration: 250ms;"
                        >
                            <div
                                class="planFormContainer"
                                data-uia="form-plan-selection"
                            >
                                <div>
                                    <div
                                        class="stepHeader-container"
                                        data-uia="header"
                                    >
                                        <div
                                            class="stepHeader"
                                            data-a11y-focus="true"
                                            tabindex="0"
                                        >
                                            <span
                                                id=""
                                                class="stepIndicator"
                                                data-uia=""
                                            >
                                                STEP <b>2</b> OF <b>3</b>
                                            </span>
                                            <h1
                                                class="stepTitle"
                                                data-uia="stepTitle"
                                            >
                                                Choose the plan that’s right for
                                                you.
                                            </h1>
                                        </div>
                                    </div>
                                    <div class="changeAnytime">
                                        Downgrade or upgrade at any time.
                                    </div>
                                </div>
                                <div
                                    class="planGrid planGrid--has3Plans"
                                    data-uia="plan-grid"
                                >
                                    <div class="planGrid__header">
                                        <div
                                            class="planGrid__selector planGrid__planSelector"
                                            role="radiogroup"
                                            aria-label="Plan"
                                            aria-describedby="planGrid_planChoice_description"
                                            data-uia="plan-grid-plan-selector"
                                        >
                                            <span
                                                class="planGrid__selectorDescription"
                                                id="planGrid_planChoice_description"
                                                data-uia="plan-grid-plan-selector+description"
                                                aria-hidden="true"
                                            >
                                                Select the plan you'd like
                                            </span>
                                            <label
                                                class="planGrid__selectorChoice planGrid__planChoice"
                                                for="planGrid_planChoice_1"
                                                data-uia="plan-grid-plan-selector+label-text_2_stream_name"
                                                ><input
                                                    type="radio"
                                                    name="planChoice"
                                                    class="planGrid__selectorInput planGrid__planInput"
                                                    id="planGrid_planChoice_1"
                                                    data-uia="plan-grid-plan-selector+input-text_2_stream_name"
                                                    value="estandar"
                                                /><span
                                                    class="planGrid__selectorLabel planGrid__planLabel"
                                                    >Estándar</span
                                                ></label
                                            ><label
                                                class="planGrid__selectorChoice planGrid__planChoice"
                                                for="planGrid_planChoice_2"
                                                data-uia="plan-grid-plan-selector+label-text_4_stream_name"
                                                ><input
                                                    type="radio"
                                                    name="planChoice"
                                                    class="planGrid__selectorInput planGrid__planInput"
                                                    id="planGrid_planChoice_2"
                                                    data-uia="plan-grid-plan-selector+input-text_4_stream_name"
                                                    value="premium"
                                                    checked=""
                                                /><span
                                                    class="planGrid__selectorLabel planGrid__planLabel"
                                                    >Premium</span
                                                ></label
                                            >
                                        </div>
                                    </div>
                                    <table
                                        class="planGrid__featureTable"
                                        role="table"
                                        data-uia="plan-grid-feature-table"
                                    >
                                        <caption
                                            class="planGrid__featureTableCaption"
                                        >
                                            Netflix Plan Features
                                        </caption>
                                        <tbody
                                            class="planGrid__featureTableBody"
                                            data-uia="plan-grid-feature-table-body"
                                        >
                                            <tr
                                                role="row"
                                                class="planGrid__featureTableRow"
                                            >
                                                <td
                                                    class="planGrid__cell planGrid__featureCell"
                                                    role="cell"
                                                    data-uia="plan-grid-feature-table-cell+planPrice-feature"
                                                >
                                                    Monthly price (pre-tax)
                                                </td>

                                                <td
                                                    class="planGrid__cell planGrid__stringCell"
                                                    role="cell"
                                                    data-uia="plan-grid-feature-table-cell+planPrice-text_2_stream_name"
                                                    aria-label="Standard"
                                                >
                                                    ARS319
                                                </td>
                                                <td
                                                    class="planGrid__cell planGrid__cell--isSelected planGrid__stringCell"
                                                    role="cell"
                                                    data-uia="plan-grid-feature-table-cell+planPrice-text_4_stream_name"
                                                    aria-label="Premium"
                                                >
                                                    ARS449
                                                </td>
                                            </tr>
                                            <tr
                                                role="row"
                                                class="planGrid__featureTableRow"
                                            >
                                                <td
                                                    class="planGrid__cell planGrid__featureCell"
                                                    role="cell"
                                                    data-uia="plan-grid-feature-table-cell+planHasHd-feature"
                                                >
                                                    HD available
                                                </td>
                                                <td
                                                    class="planGrid__cell planGrid__booleanCell"
                                                    role="cell"
                                                    data-uia="plan-grid-feature-table-cell+planHasHd-text_2_stream_name"
                                                    aria-label="Standard"
                                                >
                                                    <span
                                                        class="planGrid__booleanLabel"
                                                        >Yes</span
                                                    ><span
                                                        class="planGrid__booleanIcon"
                                                        aria-hidden="true"
                                                    >
                                                        <svg
                                                            id="thin-check"
                                                            viewBox="0 0 26 26"
                                                            class="svg-icon svg-icon-thin-check planGrid__booleanGraphic"
                                                            focusable="true"
                                                        >
                                                            <path
                                                                d="M9.19 22.892L.5 14.198l1.232-1.233 7.236 7.24L23.793.516l1.38 1.04L9.19 22.892"
                                                            ></path>
                                                        </svg>
                                                    </span>
                                                </td>
                                                <td
                                                    class="planGrid__cell planGrid__cell--isSelected planGrid__booleanCell"
                                                    role="cell"
                                                    data-uia="plan-grid-feature-table-cell+planHasHd-text_4_stream_name"
                                                    aria-label="Premium"
                                                >
                                                    <span
                                                        class="planGrid__booleanLabel"
                                                        >Yes</span
                                                    ><span
                                                        class="planGrid__booleanIcon"
                                                        aria-hidden="true"
                                                        ><svg
                                                            id="thin-check"
                                                            viewBox="0 0 26 26"
                                                            class="svg-icon svg-icon-thin-check planGrid__booleanGraphic"
                                                            focusable="true"
                                                        >
                                                            <path
                                                                d="M9.19 22.892L.5 14.198l1.232-1.233 7.236 7.24L23.793.516l1.38 1.04L9.19 22.892"
                                                            ></path>
                                                          </svg>
                                                      </span>
                                                </td>
                                            </tr>
                                            <tr
                                                role="row"
                                                class="planGrid__featureTableRow"
                                            >
                                                <td
                                                    class="planGrid__cell planGrid__featureCell"
                                                    role="cell"
                                                    data-uia="plan-grid-feature-table-cell+planHasUltraHd-feature"
                                                >
                                                    Ultra HD available
                                                </td>

                                                <td
                                                    class="planGrid__cell planGrid__booleanCell"
                                                    role="cell"
                                                    data-uia="plan-grid-feature-table-cell+planHasUltraHd-text_2_stream_name"
                                                    aria-label="Standard"
                                                >
                                                    <span
                                                        class="planGrid__booleanLabel"
                                                        >No</span
                                                    ><span
                                                        class="planGrid__booleanIcon"
                                                        aria-hidden="true"
                                                        ><svg
                                                            id="thin-x"
                                                            viewBox="0 0 26 26"
                                                            class="svg-icon svg-icon-thin-x planGrid__booleanGraphic"
                                                            focusable="true"
                                                        >
                                                            <path
                                                                d="M10.5 9.3L1.8 0.5 0.5 1.8 9.3 10.5 0.5 19.3 1.8 20.5 10.5 11.8 19.3 20.5 20.5 19.3 11.8 10.5 20.5 1.8 19.3 0.5 10.5 9.3Z"
                                                            ></path></svg>
                                                      </span>
                                                </td>
                                                <td
                                                    class="planGrid__cell planGrid__cell--isSelected planGrid__booleanCell"
                                                    role="cell"
                                                    data-uia="plan-grid-feature-table-cell+planHasUltraHd-text_4_stream_name"
                                                    aria-label="Premium"
                                                >
                                                    <span
                                                        class="planGrid__booleanLabel"
                                                        >Yes</span
                                                    ><span
                                                        class="planGrid__booleanIcon"
                                                        aria-hidden="true"
                                                        ><svg
                                                            id="thin-check"
                                                            viewBox="0 0 26 26"
                                                            class="svg-icon svg-icon-thin-check planGrid__booleanGraphic"
                                                            focusable="true"
                                                        >
                                                            <path
                                                                d="M9.19 22.892L.5 14.198l1.232-1.233 7.236 7.24L23.793.516l1.38 1.04L9.19 22.892"
                                                            ></path></svg></span>
                                                </td>
                                            </tr>
                                            <tr
                                                role="row"
                                                class="planGrid__featureTableRow"
                                            >
                                                <td
                                                    class="planGrid__cell planGrid__featureCell"
                                                    role="cell"
                                                    data-uia="plan-grid-feature-table-cell+planMaxScreenCount-feature"
                                                >
                                                    Screens you can watch on at
                                                    the same time
                                                </td>

                                                <td
                                                    class="planGrid__cell planGrid__stringCell"
                                                    role="cell"
                                                    data-uia="plan-grid-feature-table-cell+planMaxScreenCount-text_2_stream_name"
                                                    aria-label="Standard"
                                                >
                                                    2
                                                </td>
                                                <td
                                                    class="planGrid__cell planGrid__cell--isSelected planGrid__stringCell"
                                                    role="cell"
                                                    data-uia="plan-grid-feature-table-cell+planMaxScreenCount-text_4_stream_name"
                                                    aria-label="Premium"
                                                >
                                                    4
                                                </td>
                                            </tr>
                                            <tr
                                                role="row"
                                                class="planGrid__featureTableRow"
                                            >
                                                <td
                                                    class="planGrid__cell planGrid__featureCell"
                                                    role="cell"
                                                    data-uia="plan-grid-feature-table-cell+4-feature"
                                                >
                                                    Watch on your laptop, TV,
                                                    phone and tablet
                                                </td>

                                                <td
                                                    class="planGrid__cell planGrid__booleanCell"
                                                    role="cell"
                                                    data-uia="plan-grid-feature-table-cell+4-text_2_stream_name"
                                                    aria-label="Standard"
                                                >
                                                    <span
                                                        class="planGrid__booleanLabel"
                                                        >Yes</span
                                                    ><span
                                                        class="planGrid__booleanIcon"
                                                        aria-hidden="true"
                                                        ><svg
                                                            id="thin-check"
                                                            viewBox="0 0 26 26"
                                                            class="svg-icon svg-icon-thin-check planGrid__booleanGraphic"
                                                            focusable="true"
                                                        >
                                                            <path
                                                                d="M9.19 22.892L.5 14.198l1.232-1.233 7.236 7.24L23.793.516l1.38 1.04L9.19 22.892"
                                                            ></path></svg></span>
                                                </td>
                                                <td
                                                    class="planGrid__cell planGrid__cell--isSelected planGrid__booleanCell"
                                                    role="cell"
                                                    data-uia="plan-grid-feature-table-cell+4-text_4_stream_name"
                                                    aria-label="Premium"
                                                >
                                                    <span
                                                        class="planGrid__booleanLabel"
                                                        >Yes</span
                                                    ><span
                                                        class="planGrid__booleanIcon"
                                                        aria-hidden="true"
                                                        ><svg
                                                            id="thin-check"
                                                            viewBox="0 0 26 26"
                                                            class="svg-icon svg-icon-thin-check planGrid__booleanGraphic"
                                                            focusable="true"
                                                        >
                                                            <path
                                                                d="M9.19 22.892L.5 14.198l1.232-1.233 7.236 7.24L23.793.516l1.38 1.04L9.19 22.892"
                                                            ></path></svg></span>
                                                </td>
                                            </tr>
                                            <tr
                                                role="row"
                                                class="planGrid__featureTableRow"
                                            >
                                                <td
                                                    class="planGrid__cell planGrid__featureCell"
                                                    role="cell"
                                                    data-uia="plan-grid-feature-table-cell+5-feature"
                                                >
                                                    Unlimited movies and TV
                                                    shows
                                                </td>

                                                <td
                                                    class="planGrid__cell planGrid__booleanCell"
                                                    role="cell"
                                                    data-uia="plan-grid-feature-table-cell+5-text_2_stream_name"
                                                    aria-label="Standard"
                                                >
                                                    <span
                                                        class="planGrid__booleanLabel"
                                                        >Yes</span
                                                    ><span
                                                        class="planGrid__booleanIcon"
                                                        aria-hidden="true"
                                                        ><svg
                                                            id="thin-check"
                                                            viewBox="0 0 26 26"
                                                            class="svg-icon svg-icon-thin-check planGrid__booleanGraphic"
                                                            focusable="true"
                                                        >
                                                            <path
                                                                d="M9.19 22.892L.5 14.198l1.232-1.233 7.236 7.24L23.793.516l1.38 1.04L9.19 22.892"
                                                            ></path></svg></span>
                                                </td>
                                                <td
                                                    class="planGrid__cell planGrid__cell--isSelected planGrid__booleanCell"
                                                    role="cell"
                                                    data-uia="plan-grid-feature-table-cell+5-text_4_stream_name"
                                                    aria-label="Premium"
                                                >
                                                    <span
                                                        class="planGrid__booleanLabel"
                                                        >Yes</span
                                                    ><span
                                                        class="planGrid__booleanIcon"
                                                        aria-hidden="true"
                                                        ><svg
                                                            id="thin-check"
                                                            viewBox="0 0 26 26"
                                                            class="svg-icon svg-icon-thin-check planGrid__booleanGraphic"
                                                            focusable="true"
                                                        >
                                                            <path
                                                                d="M9.19 22.892L.5 14.198l1.232-1.233 7.236 7.24L23.793.516l1.38 1.04L9.19 22.892"
                                                            ></path></svg></span>
                                                </td>
                                            </tr>
                                            <tr
                                                role="row"
                                                class="planGrid__featureTableRow"
                                            >
                                                <td
                                                    class="planGrid__cell planGrid__featureCell"
                                                    role="cell"
                                                    data-uia="plan-grid-feature-table-cell+6-feature"
                                                >
                                                    Cancel anytime
                                                </td>

                                                <td
                                                    class="planGrid__cell planGrid__booleanCell"
                                                    role="cell"
                                                    data-uia="plan-grid-feature-table-cell+6-text_2_stream_name"
                                                    aria-label="Standard"
                                                >
                                                    <span
                                                        class="planGrid__booleanLabel"
                                                        >Yes</span
                                                    ><span
                                                        class="planGrid__booleanIcon"
                                                        aria-hidden="true"
                                                        ><svg
                                                            id="thin-check"
                                                            viewBox="0 0 26 26"
                                                            class="svg-icon svg-icon-thin-check planGrid__booleanGraphic"
                                                            focusable="true"
                                                        >
                                                            <path
                                                                d="M9.19 22.892L.5 14.198l1.232-1.233 7.236 7.24L23.793.516l1.38 1.04L9.19 22.892"
                                                            ></path></svg></span>
                                                </td>
                                                <td
                                                    class="planGrid__cell planGrid__cell--isSelected planGrid__booleanCell"
                                                    role="cell"
                                                    data-uia="plan-grid-feature-table-cell+6-text_4_stream_name"
                                                    aria-label="Premium"
                                                >
                                                    <span
                                                        class="planGrid__booleanLabel"
                                                        >Yes</span
                                                    ><span
                                                        class="planGrid__booleanIcon"
                                                        aria-hidden="true"
                                                        ><svg
                                                            id="thin-check"
                                                            viewBox="0 0 26 26"
                                                            class="svg-icon svg-icon-thin-check planGrid__booleanGraphic"
                                                            focusable="true"
                                                        >
                                                            <path
                                                                d="M9.19 22.892L.5 14.198l1.232-1.233 7.236 7.24L23.793.516l1.38 1.04L9.19 22.892"
                                                            ></path></svg></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <small class="planGrid__legal"
                                        ><span id="" data-uia="plan-grid-legal"
                                            >HD and Ultra HD availability
                                            subject to your Internet service and
                                            device capabilities. Not all content
                                            available in HD or Ultra HD. See
                                            <a
                                                href="/termsofuse"
                                                target="_blank"
                                                >Terms of Use</a
                                            >
                                            for more details.</span
                                        ></small
                                    >
                                </div>
                            </div>
                            <div class="loadingText">
                                <div class="loadingTextContent">
                                    <span></span>
                                </div>
                            </div>
                            <div class="submitBtnContainer">
                                <button
                                    type="button"
                                    autocomplete="off"
                                    class="nf-btn nf-btn-primary nf-btn-solid nf-btn-oversize"
                                    data-uia="cta-plan-selection"
                                    placeholder="planSelection_button_continue"
                                >
                                    CONTINUE
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
