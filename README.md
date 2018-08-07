# PHP Evolver: A Genetic Algorithm Framework

[Genetic Alorithms](https://en.wikipedia.org/wiki/Genetic_algorithm) are a class of machine learning approaches that use the principles of natural selection, rather than the solving of mathematical formulae to find solutions to optimisation and search type problems. They are especially effective in complex situation that aren't easily "solved" and can often be used as a more-easily understood alternative to neural networks.

This framework takes care of most of the steps (loops) needed when developing and running a genetic algorithm, leaving you needing only to define the shape of your expected solution and a function to evaluate each candidate faciliating their comparison and thus the march towards an optimum. 

## Installation

You can install the package via composer:

```bash
composer require phpexperts/php-evolver
```

## Usage

### Framing and Finding Solutions

Firstly create a class that defines a generic solution to the problem to be solved. The class must extend this package's Solution class, which will force the implemetation of two methods: genome() which defines the shape of a valid solution and evaluate(), which will calculate a numerical value that can be used to compare solutions.

``` php
use PHPExperts\GAO\Solution;

class MySolution extends Solution
{
    public function genome()
    {
        return [
            ['char', 'ABC'],
            ['float', 0, 1], // upper and lower bounds
            ['integer', -100, 100],
        ];
    }

    public function evaluate($data = null)
    {
        // The smaller the fitness value, the better.
        $this->fitness = (ord($this->chromosomes[0]) + $this->chromosomes[2]) / $this->chromosomes[1];
    }
}
```

Then instantiate and run the optimiser, creating an initial population of possible solutions to start its evaluation.

``` php
$optimiser = new Breeder(new Population(MySolution::class, 100));
$optimiser->run();
foreach ($optimiser->results as $solution) {
    print_r($solution->summary());
}
```

### Data Manager

Although some use cases may not require much, if any, data against which to evaluate candidate solutions, others may need astronomical amounts. This could be be the case in financial markets where a trading strategy is sought and candidates are evaluated against the evolution of prices for many different securities, or in sports trading markets where possible strategies may be evaluated against changes in odds for thousands of events.

The DataManager class offers utilities optimised to assist with htese challenges. Here's the sort of thing that it can do:

``` php
$dm = new DataManager();

// loads all files (assumed to be in CSV format) from given directory into an collection
$data = $dm->loadCsvDir('path/to/directory');

// PHP is really slow importing data into arrays - so once done, save the results (as json)
$dm->save('path/to/output/file', $data);

// It can be reloaded later from a json file in a tiny fraction of the time taken by the initial import
$data = $dm->load('path/to/output/file');

// to ensure our solutions works on data not seen during training, we may set aside some data (20% below) just for testing
list($trainingData, $testingData) = $dm->split($data, 0.2);
```

PHP is also rather memory hungry when constructing arrays. If you experience out of memory errors, then the following may help:

``` php
$dm->setMemoryLimit('1G'); // increases memory for the current process only, accepts values in M or G e.g. 512M or 2Gs
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email peterdcoles@gmail.com instead of using the issue tracker. I take security very seriously and will welcome and respond promptly to your input.

## Credits

Forked from https://github.com/ptercoles/genetic-algorithm-optimiser

- [Theodore R. Smith](https://github.com/hopeseekr)
- [Peter Coles](https://github.com/petercoles)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
