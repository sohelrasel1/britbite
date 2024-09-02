<table class="table table-striped mb-5 bbcodes-table border">
    <thead>
    <tr>
        <th scope="col">{{__('Short Code')}}</th>
        <th scope="col">{{__('Meaning')}}</th>
    </tr>
    </thead>
    <tbody>

    @if ($templateInfo->email_type == 'email_verification' ||  $templateInfo->email_type == 'course_enrolment')
        <tr>
            <td>
                {customer_name}
            </td>
            <th scope="row">
                {{__('Customer Name')}}
            </th>
        </tr>
    @endif
    @if($templateInfo->email_type == 'email_verification')
        <tr>
            <td>
                {verification_link}
            </td>
            <th scope="row">
                {{__('Email verification link')}}
            </th>
        </tr>
    @endif
    @if ($templateInfo->email_type != 'email_verification' && $templateInfo->email_type != 'course_enrolment')
        <tr>
            <td>
                {username}
            </td>
            <th scope="row">
                {{__('Username')}}
            </th>
        </tr>
    @endif

    @if ($templateInfo->email_type == 'custom_domain_connected' || $templateInfo->email_type == 'custom_domain_rejected')
        <tr>
            <td>
                {requested_domain}
            </td>
            <th scope="row">
                {{__('Requested Custom Domain of User')}}
            </th>
        </tr>
    @endif
    @if ($templateInfo->email_type == 'custom_domain_connected')
        <tr>
            <td>
                {previous_domain}
            </td>
            <th scope="row">
                {{__('Previous Custom Domain of User')}}
            </th>
        </tr>
    @endif
    @if ($templateInfo->email_type == 'custom_domain_rejected')
        <tr>
            <td>
                {current_domain}
            </td>
            <th scope="row">
                {{__('Current Custom Domain of User')}}
            </th>
        </tr>
    @endif
    @if ($templateInfo->email_type == 'registration_with_premium_package' || $templateInfo->email_type == 'registration_with_trial_package' || $templateInfo->email_type == 'registration_with_free_package' || $templateInfo->email_type == 'membership_extend' || $templateInfo->email_type == 'payment_accepted_for_membership_extension_offline_gateway' || $templateInfo->email_type == 'payment_accepted_for_registration_offline_gateway')
        <tr>
            <td>
                {package_title}
            </td>
            <th scope="row">
                {{__('Package Name')}}
            </th>
        </tr>
        <tr>
            <td>
                {package_price}
            </td>
            <th scope="row">
                {{__('Price of Purchased Package')}}
            </th>
        </tr>

        @if ($templateInfo->email_type == 'registration_with_premium_package' || $templateInfo->email_type == 'payment_accepted_for_registration_offline_gateway')
        <tr>
            <td>
                {discount}
            </td>
            <th scope="row">
                {{__('Discount after Coupon Applied')}}
            </th>
        </tr>
        <tr>
            <td>
                {total}
            </td>
            <th scope="row">
                {{__('Order Total')}}
            </th>
        </tr>
        @endif

        <tr>
            <td>
                {activation_date}
            </td>
            <th scope="row">
                {{__('Start Date of Membership')}}
            </th>
        </tr>
        <tr>
            <td>
                {expire_date}
            </td>
            <th scope="row">
                {{__('Expire Date of Membership')}}
            </th>
        </tr>
    @endif
    @if ($templateInfo->email_type == 'membership_expiry_reminder')
        <tr>
            <td>
                {last_day_of_membership}
            </td>
            <th scope="row">
                {{__('Last day of membership')}}
            </th>
        </tr>
    @endif
    @if ($templateInfo->email_type == 'membership_expiry_reminder' || $templateInfo->email_type == 'membership_expired')
        <tr>
            <td>
                {login_link}
            </td>
            <th scope="row">
                {{__('Login Page Link for User')}}
            </th>
        </tr>
    @endif
    @if($templateInfo->email_type == 'course_enrolment')
        <tr>
            <td>
                {order_id}
            </td>
            <th scope="row">
                {{ __('Order Id of Course Enrolment') }}
            </th>
        </tr>
    @endif

    @if ($templateInfo->email_type == 'course_enrolment')
        <tr>
            <td>
                {title}
            </td>
            <th scope="row">
                {{ __('Course Title') }}
            </th>
        </tr>
    @endif


    <tr>
        <td>
            {website_title}
        </td>
        <th scope="row">
            Website Title
        </th>
    </tr>

    </tbody>
</table>
