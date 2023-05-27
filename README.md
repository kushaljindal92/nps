# Magento 2 Net Promotor score Module

What is NPS ?
NPS stands for Net Promoter Score. It is a widely used metric to measure customer loyalty and satisfaction with a company, brand, or product. NPS is based on the idea that customers can be categorized into three groups: promoters, passives, and detractors.

    Promoters: These are customers who are highly satisfied with the company, brand, or product and are likely to recommend it to others.

    Passives: These customers are somewhat satisfied but not enthusiastic about the company, brand, or product. They may be susceptible to competitive offerings or may not actively promote or recommend it.

    Detractors: These customers are dissatisfied or unhappy with the company, brand, or product. They may actively discourage others from using it.

To calculate the Net Promoter Score, customers are typically asked to rate on a scale of 0 to 10, how likely they are to recommend the company, brand, or product to others. Based on their responses, they are classified into the three categories mentioned above.

The Net Promoter Score is calculated by subtracting the percentage of detractors from the percentage of promoters. The score can range from -100 to +100, with higher scores indicating higher customer satisfaction and loyalty.

NPS is commonly used as a benchmarking tool and a key performance indicator (KPI) for businesses to assess customer sentiment, track changes over time, and identify areas for improvement in their products or services.

### Type 1: Zip file

 - Unzip the zip file in `app/code/Magentomaster`
 - Enable the module by running `php bin/magento module:enable Magentomaster_Nps`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`


#Module Flow
1. when an order is marked completed a NPS email is triggered on customer email id. Customer recieved it and give feedback clicking on one of score. That score get submitted and coupon is generated to customer on his email id. That coupon can only be used by that customer only.

#Validated Environment
Magento 2.4.6 and later version
PHP 8.1 and later version
Mariadb 15.* and later version

![image](https://raw.githubusercontent.com/kushaljindal92/nps/main/screenshot/Screenshot%202023-05-26%20at%207.12.45%20PM.png)
![image](https://raw.githubusercontent.com/kushaljindal92/nps/main/screenshot/Screenshot%202023-05-26%20at%207.11.18%20PM.png)
![image](https://raw.githubusercontent.com/kushaljindal92/nps/main/screenshot/Screenshot%202023-05-26%20at%207.12.04%20PM.png)
![image](https://raw.githubusercontent.com/kushaljindal92/nps/main/screenshot/Screenshot%202023-05-26%20at%207.11.35%20PM.png)
