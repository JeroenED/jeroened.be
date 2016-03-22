<?php
namespace JeroenED\CmsEDBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Output\OutputInterface;
use JeroenED\CmsEDBundle\Entity\User;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;

/**
 * Description of CreateUserCommand
 *
 * @author Jeroen De Meerleer <me@jeroened.be>
 */
class CreateUserCommand extends ContainerAwareCommand {
    
    protected function configure()
    {
        $this
            ->setName('CmsED:Users:Create')
            ->setDescription('Create first user for CmsED')
            ->addArgument(
                'username',
                InputArgument::OPTIONAL,
                'What is the username?'
            )
            ->addArgument(
                'email',
                InputArgument::OPTIONAL,
                'What is the e-mailaddress?'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $user = new user();
        $username = $input->getArgument('username');
        if ($username == '') {
            $questionuser = new question('Please enter your username?');
            $username = $helper->ask($input, $output, $questionuser);
            if($username == NULL) {
                throw new \Exception('The username can not be empty');
            }
        }
        $user->setUsername($username);
        $email = $input->getArgument('email');
        if ($email == '') {
            $questionemail = new question('Please enter your e-mail?');
            $email = $helper->ask($input, $output, $questionemail);
            if($email == NULL) {
                throw new \Exception('The email can not be empty');
            }
        }
        $user->setEmail($email);
        $questionpass1 = new Question('Please enter your password?');
        $questionpass1 ->setValidator(function ($value) {
            if (trim($value) == '') {
                throw new \Exception('The password can not be empty');
            }

            return $value;
        });
        $questionpass1 ->setHidden(true);
        $questionpass1 ->setMaxAttempts(20);
        $password1 = $helper->ask($input, $output, $questionpass1);
        
        $questionpass2 = new Question('Please enter your password again?');
        $questionpass2 ->setValidator(function ($value) {
            if (trim($value) == '') {
                throw new \Exception('The password can not be empty');
            }

            return $value;
        });
        $questionpass2 ->setHidden(true);
        $questionpass2 ->setMaxAttempts(20);
        $password2 = $helper->ask($input, $output, $questionpass2);
        
        if($password1 != $password2) {
            throw new \Exception('The passwords are not equal');
        }
        
        $factory = $this->getContainer()->get('security.encoder_factory');

        $encoder = $factory->getEncoder($user);
        $password = $encoder->encodePassword($password1, $user->getSalt());
        $user->setPassword($password);
        
        $db = $this->getContainer()->get('doctrine')->getManager();
        $db->persist($user);
        $db->flush();
    }
}
