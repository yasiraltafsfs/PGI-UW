Hi we're looking for someone that will help us integrate Stripe into our platform. The exact details are laid out below:

- Payment Gateway Integration with Stripe on Laravel 8/9 - Stripe's SDK can be used
- Create methods so that a customer can add different payment methods to their profile - CC and ACH
- Create methods for charging CC and ACH that have been added by the customer(including fraud detection)
- Create methods for voiding/refund of transaction to original payment method
- Implement as a module which can be accessed from the rest of the platform
- The integration needs to be done using Laravel Contracts with implementation of Factory Design Pattern, in order to use a Factory Manager to generate classes for different Payment Gateways - So that in the future different Payment Gateways (Square/Authorize.net etc.) can be integrated on the same contract.
- Save customer profile/info on Stripe's end for recurring transactions (both ACH and CC) without asking the customer for their CC/ACH details multiple times
- Update customer profile/info - Set/Unset default payment method (CC or ACH) on Stripe's end
- Valid/Invalid check of customer profile info
- Respond with 5 in your cover letter
- Delete customer profile - use soft delete
- Design a basic DB schema to support above requirements - users table, payment gateway/methods tables, transactions table and required relationships etc.
- Ideally we would prefer usage of repository pattern in data layer interactions
- A basic UI for showcasing and testing the above integration
- Use Bootstrap for UI styling and Vue.js for UI components (this is optional, candidate can use whichever Frontend stack they are comfortable with)
- Write unit tests to validate code - Unit tests should be thorough and should account for multiple use cases

The ideal candidate will be familiar with Laravel 8/9, PHP 7.x/8, have experience with vue.js and jQuery and Bootstrap. If this project goes well, we'd like to invite the individual to join our team. In that regard, agencies are not welcome.

All candidates must be available to speak via a video conference before being hired, and will periodically need to jump on team calls as necessary.