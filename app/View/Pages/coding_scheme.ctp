<?php $this->start('sidebar'); ?>
<div class="span3">
<ul class="nav nav-list osfa-affix-sidenav" data-spy="affix">
	<li class="active"><a href="#overview"><i class="icon-chevron-right"></i> Overview</a></li>
	<li><a href="#organization"><i class="icon-chevron-right"></i> Organization</a></li>
	<li><a href="#articles"><i class="icon-chevron-right"></i> &nbsp;&nbsp;Articles</a></li>
	<li><a href="#studies"><i class="icon-chevron-right"></i> &nbsp;&nbsp;Studies</a></li>
	<li><a href="#effects"><i class="icon-chevron-right"></i> &nbsp;&nbsp;Effects</a></li>
	<li><a href="#tests"><i class="icon-chevron-right"></i> &nbsp;&nbsp;Tests</a></li>
</ul>
</div>
<?php $this->end(); ?>
<header id="overview">
   <h1>Coding scheme</h1>
   <p class="lead">What is the coding scheme?</p>
</header>

<p>In <strong>Stage 1</strong>, articles from the 2008 sample will be coded according to a scheme. <br>
	In <strong>Stage 2</strong>, coders will search the literature forward for articles published since then that have explicitly replicated one or more of each 2008 article’s effects.</p>

<p>The Stage 1 coding scheme can be applied to any empirical article in psychology that reports quantitative methods and inferential statistics. It follows a “nested” format, explained below. </p>

<section id="organization">
<h2>Moving from the highest level of organization to the lowest: </h2>

<ol>
	<li>We start with a number of <b>articles</b>. </li>
	<li>Each article reports one or more <b>studies</b>. These are reported within the article and numbered (“Study 1,” Study 5a” and so forth). </li>
	<li>Each study contains one or more <b>effects</b>, each of which is related to the hypotheses of the study. Effects are specific relationships among groups of conceptual variables, which the study may test in several different ways with manipulations and measures. Some complex effects – like those supporting mediation or interaction hypotheses – will involve more than two variables. 

	<p><i>For example, if a study manipulates hunger by recruiting participants either before or after lunch, and measures self-control by asking them their preference for some money now or more money later, the underlying variables are “hunger” and “self-control.” The hypothesis may be that “hunger will increase self-control” but even if the authors don’t state a clear hypothesis, the article should state that they are interested in the relationship between the two variables. </i></p>
	<p>One study report may contain many effects. However, we are interested in two particular kinds of effects, and only these should be coded:</p>

	<h4>Key novel effects</h4>

	<p>We are assuming that the Abstract will report the effects related to each study that are both novel to the article, and critical for the overall argument of the article. To find these effects, look only at the Abstract. Each key effect may be reported either as hypotheses (e.g., “We expected that gender would relate to coping style”), as findings (“ e.g., “Women showed more interdependent coping styles than men”), or as both. Create a separate effect for each relationship among variables mentioned in the Abstract. If an effect applies to multiple studies (e.g. “We expected that gender would relate to coping style. Three questionnaire studies tested this hypothesis”), create a separate effect under each study.</p>

	<h4>Replication effects</h4>

	<p>This kind of effect is more difficult to identify, and will require reading the Introduction and Discussion of the article as well as the Abstract. Here, we are looking for effects in the present study that the authors specifically link to the methods and results of one or more previously published articles. What’s more, all the variables in the effect, and the relationship among them, must correspond to a similar effect found previously. </p>

	<p>References to replication effects may or may not use the word “replicate” – some alternatives are:</p>
	<blockquote>
		As in [previous study], we expected that …<br>
		Because [previous study] found [X], we also expect that …<br>
		Unlike [previous study], we used a general population sample, which may explain why we did not find [X] as they did.
	</blockquote>
	<p>The variables need not literally be the same as the previous study but must be presented as measuring the same things. If the emphasis is on changing</p>

	<p>Note also that there is a common technique called “replicate and extend” in which a study incorporates the measures and manipulations corresponding to of a previous study, so is able to replicate its hypothesis, but then adds new measures or manipulations to answer novel questions. Your division of effects should distinguish between new effects and replication effects</p>

	<h5>Specific design issues in effects: Overall versus specific effects</h5>
	<p>Sometimes an effect is phrased in terms of an overall effect, which then has sub-effects that can be tested. Examples of this are:</p>

<ol>
	<li>An experiment with five conditions, where the overall ANOVA for the experiment shows that there are differences among conditions, but the key effect is a comparison pitting one condition against two control conditions.</li>
	<li>An effect that states that men should show a stronger correlation between two variables than women do. This is sometimes tested by looking at the size and significance of each correlation separately. However, it is better to directly test the difference in size of the two correlations overall, or to carry out an equivalent analysis by testing the overall interaction effect between the continuous IV and gender upon the DV.</li>
	<li>An effect that states that an experimental manipulation should work on people from one culture but not from another. Again, this can be tested by looking separately within each culture, or by doing an overall 2x2 interaction analysis.</li>
</ol>
<h5>Specific design issues in effects: Model testing</h5>
<p>Some statistical analyses – in particular, structural equation modeling – take an approach called “model testing” where the authors propose a complex model involving multiple variables and are interested in how well the model fits the data. </p>

<p>When the goal is to test a model, there is no need to list all the relationships among variables separately; simply create one effect for each model tested. However, if the authors focus in on specific effects within models (for example, they place special importance on a path linking three variables) then these should get their own effect.</p>
</li>
	<li>Finally, each effect will have one or more statistical <b>tests</b> of significance. Effects can have multiple tests if the underlying variables that are key to the effect are measured or manipulated in more than one way. Tests are stated in terms of what was actually done to manipulate and measure variables.
		<p><i>In the above example, if the authors report a t-test between the before and after lunch conditions on mean money preference, that is one test related to the hypothesis that hunger increases self-control. If they also calculate the correlation between a measure of hunger and money preference, that is another test of the same effect, because they are using a different method (measured hunger, rather than manipulated time of recruitment) to get at the same conceptual variable (hunger). Likewise, if they report another t-test between conditions where the dependent variable measures self-control through number of candies eaten out of a dish, rather than money preference, this would be a test related to the same effect, but with a different measure of the conceptual variable “self-control.”</i></p>
<p>Another way to think of the nesting is to move from the lowest level of organization to the highest. So, each entry in the database represents a single significance test of a hypothesis that is related to the major effects in the study. Not all significance tests get their own entry; for example, if the hypothesis being tested is mentioned in the results section but not in the Introduction or discussion, it doesn’t get an entry. Each significance test is associated with an effect it is testing; a study it was part of; and an article it was part of.</p>

	<p>Different pieces of information are associated with the different levels in the database. For example, there is one p value per statistical test so that goes in at the “test” level. Whether a hypothesis was presented as a prediction of the effect goes in at the “effect” level, and you don’t need to enter it separately for each of the tests that relate to that effect. Whether the study is presented by its authors as a replication relates to the study level, and again, you don’t need to enter it separately for each test within that study.</p>

	<p>The coding scheme is entered through an online front-end at <a href="http://archival.dyden.de/">http://archival.dyden.de/</a>, and ends up as one .xls format spreadsheet per journal, centrally stored (e.g. on Google Docs) and updated by contributors. Each spreadsheet has two pages. One lists articles and article-level information; the other lists the studies and effects within each article, with one row per hypothesis test.</p>
	 </li>
</ol>
</section>
<section id="articles">
<h4>Coding scheme: Article-level information</h4>

<ol>
	<li>Article ID number (assigned by us, format = 2 digit journal code + 4 digit article code)<br>
		<i>The journal code is 01 for Psychological Science; 02 for Journal of Personality and Social Psychology; 03 for Journal of Experimental Psychology: Learning, Memory and Cognition. The article code is assigned with the first two digits being the issue number (01, 02 and so on) and the second two being the article number within that issue, counting only empirical articles and starting from 01, 02 etc. So, a JEP:LMC article that is the fifth empirical article in issue 1 of the time period being looked at would be 030105.</i></li>

		<li>Journal (the three initial journals will be coded PS, JPSP, JEPLMC)</li>
		<li>Bibliographic information (year, volume, pages, title, authors, DOI)</li>
		<li>Number of studies (treating e.g. “1a” and “1b” as separate studies).</li>
		<li>Number of article citations on a fixed date near the completion of the project (to be filled in last).</li>
</ol>
</section>

<section id="studies">
<h4>Study-level information</h4>

<ol>
	<li>Study number, as written in the article (such as Study 1, Study 2, Study 3a, Study 3b, etc.) If there is only one study put “1”.</li>
	<li>Replication code: The Introduction and pre-study material is the main authority for whether the authors consider their study to be a replication in any way. Coders should only apply a replication code if the authors specifically cite a preceding study or group of studies as a source whose hypothesis is being reproduced in the present research, with or without the same methodology. The word “replicate” does not need to be used, but the previous paper should be cited and explicitly named as a source of methodology for <b>at least one independent</b> and <b>at least one dependent</b> variable. However, the independent and dependent variable need not be put into practice in the exact same way as the original paper. See Schmidt (2009) for a further explanation of the types and purposes of replication. 
	<br><br>Citing a previously published methodology that covers only one variable is not enough to constitute replication, unless both the cited study and the present one are meant to validate the methodology, rather than to use it to test a hypothesis. 
	<br><br><i>Example: The current paper cites a previous paper that initially developed and validated a previously used methodology to measure attitudes, the Implicit Color Test (ICT). If the current paper’s hypothesis is that the ICT would also be valid among a community sample of adults, not just university students, then this is a replication. If the current paper’s hypothesis is that people subjected to a mindfulness exercise would show more favorable ICT scores, then this is a use of the method, not a replication of the validation article.</i>
	<br><br>This scheme is meant to also count replications that are nested within a larger design, as part of a “replicate and extend” research strategy.
	<br><br><i>For example, if a study reports that two of its conditions replicate conditions and measures from a previous study, but there are two additional conditions to answer additional questions and three additional measures, this should be counted as a replication based on the conditions and measures that do replicate previous work. </i>
	<br>The codes for replication follow.
	<li><ul>
		<li>D: Direct replication. The stated goal is, at least in part of the design, to exactly reproduce the hypothesis and methods of the previous study, making only those changes that are necessary to achieve the same psychological meaning among the new participant population. <i>Example 1: A study of stereotypes in Canada that used ice hockey players as a target group might be directly replicated in Australia by changing the target group to rugby players and pretesting for new stereotypical associations, while keeping everything else the same. Example 2: A study of lexical decision times done in Romania using Romanian words is directly replicated in Spain, with the necessary alteration of using Spanish words. Example 3: A study of psychological resilience in the aftermath of the Hurricane Katrina disaster in the US is directly replicated among those affected by the 2011 tornado outbreak, changing only references to the event. </i></li>
		<li>C: Conceptual replication. The study’s stated goal is, at least in part of the design, to test the hypothesis of the previous study, using the same conceptual variables but changing their operationalization in ways that go beyond merely adapting the materials for a new population or occasion. </li>
		<li>A conceptual replication can be done to increase internal validity (seeing if an effect replicates if the method excludes an alternate explanation), ecological validity (seeing if an effect replicates if an analogous procedure is followed using more naturalistic stimuli or setting), or external validity (seeing if the effect replicates across different conceptual incarnations of the same manipulations and measures). Note that a test of the same theory covered by previous research is not enough to warrant the “conceptual replication” label: the hypothesis (that is, a statement of relationships among variables) leading to a previous effect must be replicated.</li>
		<li><i>Example 1: A study of stereotypes in Canada that saw whether the Authoritarianism Scale predicted stereotypes of hockey players is conceptually replicated in Australia by instead manipulating levels of authoritarianism through a priming procedure and seeing the effects on stereotypes of rugby players. Example 2: A study of the effect of subject-target gender match on face recognition using forced-choice measures is followed up by a similar one using multiple-response probabilistic measures and more natural stimuli. </i></li>
		<li>+X: The letter X goes into the code after E, C, or D if the study also contains elements of <i>extension</i> that go beyond the type of replication recorded (thus, EX, CX or DX). <i>Example 1: A study of stereotypes in Canada that used ice hockey players as a target group was directly replicated in Australia by changing the target group to rugby players and pretesting for new stereotypical associations, but they also extended the study by including ethnic and sexual outgroups (Aboriginal people, gays) to see if the results would generalize. Example 2: A study of the effect of subject-target gender match on face recognition using forced-choice measures is followed up by a similar one using multiple-response probabilistic measures and more natural stimuli, which also extends the study by looking at ethnic as well as gender matching.</i></li>
		<li>+#: After the letter code, a number code without brackets is placed to show that the study is presented as a replication/extension of an earlier study in the article itself, instead of, or in addition to, replicating another article.</li>
		<li>N: No replication mentioned.</li>
	</ul></li>
	<li>Article replicated: Give the full, APA format reference for the article that the authors referenced as the source for the replication effect. If more than one article is cited, give the one from which the methods were most directly taken; if this cannot be determined, give the most recent one chronologically. If the study replicates a previous study in the same article, code as “Same.”</li>
	<li>Study replicated: From the article cited previously, if it is a multi-study article, give the number of the study with methodology closest to the present study’s, or give 1 if there is only one study.</li>
	<li>Author overlap?: Code this as Same if the present study replicates a previous paper in the article; Yes if the present study’s article has at least one author in common with the article being replicated; No if the two articles have no authors in common.</li>
</ol>
</section>
<section id="effects">
<h4>Dividing studies into effects: </h4>

<p>The primary effects of each study are defined as those which deal with a point about the data mentioned in the Abstract, either as an expectation or result. Each result is accompanied by a hypothesis which may or may not match the result, but involves the same variables. </p>

<p>Effects (results and hypotheses) should be stated as a relationship between or among variables. This can be either directional (X will be related positively/negatively to Y) or nondirectional (X will be related to Y). Effects involving multiple categories or conditions should be stated as completely as possible (if a prediction states that condition 1 will show higher anxiety than condition 2, and that both will be higher than the control condition, all three comparisons should be stated.) </p>

<p>More complex results can be stated as relations among multiple variables (Controlling for A and B, X will be related positively to Y; X’s effect will be moderated by Z such that it has a positive effect on Y only at high levels of Z).</p>

<p>Studies in psychology often include multiple hypothesis tests in their Analyses section. By requiring that effects be mentioned in the Abstract in order to be coded, we reduce the often numerous hypotheses and statistical tests in a study, keeping only the ones vital to the main points being made.</p>

<p><i>EXAMPLE: A study’s abstract reads in part, “Performing a sequential training task was expected to improve memory. This was shown across three studies; in Study 3, this effect was found only among those with an analytic learning style. In Study 2, we predicted that the sequential training task would further improve memory if repeated, but this was not shown to be the case.” </i></p>

<p><i>This yields five effects of interest. Each of the three studies has the effect “Sequential training task relates positively to memory”; Study 2 has the additional effect “repeating the sequential training task, as opposed to taking it once, will further improve memory” which was predicted but not found; Study 3 has the additional effect, “Learning style interacts with the sequential training task; only with an analytic learning style does the task relate positively to memory.”</i></p>

<p>If the research is explicitly exploratory – for example, looking at plausible predictors of a phenomenon with no aforementioned ideas about which will be most important – the study’s hypothesis and results can be stated as effects at the most general level: there are some relationships among the variables studied. </p>

<p>Effect-level information:</p>

<ol>
	<li>Code number of effect (assign these in order – 1,2,3 and so on - in order of mention).</li>
	<li>If there is a prior hypothesis relevant to the effect (that is, stated by the author as their own expectation about the research, before the results are presented), write it here, followed by the page number or numbers you found the statement on. Hypotheses are usually found near the end of the Introduction section, or in text introducing a new study between reports of studies. If the hypothesis is the same as the previous effect’s hypothesis, type “See above.” If there is no stated hypothesis before the results, type “None.”</li>
		<li><ol>
		<li>By “relevant” we mean involving the same kind of relationship among the same variables. For example, if a hypothesis states that anxiety relates positively to closeness, this is relevant to the effect stated in the Abstract that anxiety relates negatively to closeness. </li>
		<li>Hypotheses about interactions between variables may be particularly difficult to state completely, but should be reported in much the same way the authors state them (for example “Men, more so than women, should show effects of the treatment.”)</li>
		<li>If there are more specific hypotheses comparing groups, the kind of predictions that might be supported by planned comparisons, these should be reported. (for example, “More anxiety was expected in the noise group and lights group than in the silence group or the control”)</li>
		<li>Sometimes an author may state two conflicting hypotheses and expresses no clear preference between the two, preferring to let the data decide. If this appears to be the case, write both hypotheses and in square brackets the word [Alternatives].</li>
	</ol></li>
	<li>Whether the effect is a novel effect that is mentioned in the abstract (“yes”), or a replication effect (“no”; a replication effect may or may not be stated in the abstract).</li>
</ol>
</section>
<section id="tests">
<h4>Dividing effects within studies into tests:</h4>

<p>Each hypothesis within each study may be tested one or more times, depending on how many ways the study has to operationalize the independent and dependent variables of a hypothesis. </p>

<p><i>Example: A study manipulates belief in free will, then measures belief in free will after the manipulation. It tests the hypothesis that <b>low belief in free will relates to less moral orientation</b> by relating the manipulation IV to two different DVs: a self-report measure of moral identity, and a behavioural measure of cheating. Both DVS are tested to see if they vary as a function of the manipulation, and tested correlationally to see if they relate to the measures variable of belief in free will. There are therefore four tests of the hypothesis here.</i></p>

<p>Coders need to agree on the number of tests for each hypothesis and which variables they involve before proceeding. Sometimes, too, different operationalizations will be mentioned in the Abstract as separate effects. This ultimately will have little impact on the analysis of the dataset, so the Abstract should be taken as the authority on which way to proceed, no matter how arbitrarily the authors have decided to describe their effects there. </p>

<p><i>Example: In the previously mentioned study, the Abstract could a) mention all four tests as separate effects (code as 4 effects); b) mention the two different DVs as separate effects, while the tests are only mentioned in the article body text( code as 2 effects each with 2 tests); or c) only mention that low belief in free will was found to relate to less moral orientation (code as one effect with 4 tests).</i></p>

<h5>Test-level information:</h5>

<ol>
	<li>Analytic design codes (use only one) </li>
	<li><ol>
		<li><b>C = correlational/multivariate analysis without manipulation</b>
		<br>The test uses a number of variables that were measured at the same or different time – including continuous or categorical variables - but none of the test’s variables relate to the outcome of a controlled experimental manipulation.</li>
		<li><b>IA = correlational/multivariate internal analysis of manipulation check</b>
			<br>The test takes place within an experimental manipulation, but does not use a variable derived from the manipulation itself as an independent variable. Instead, it substitutes a measured variable which was a “check” on the manipulation’s effects. <i>Example: If I run an experiment in which participants listen to either an expert or inexpert communication, and measure persuasion afterwards, one possible internal analysis would test the correlation between persuasion and participants’ ratings of the communicator’s expertise. Those ratings are measuring the same thing as the experiment tried to manipulate, but do not themselves represent which condition that participant was assigned to.</i></li>
		<li><b>X = experimental analysis of manipulation effect</b>
			<br>One or more of the test’s independent variables represents which condition a participant was randomly assigned to. (Many write-ups of research these days do not explicitly mention random assignment because it is assumed to have taken place if a study is reported as an “experiment.”)</li>
		<li><b>RM = experimental analysis of repeated-measures effect</b>
			<br>One or more of the test’s <i>independent</i> variables is an analysis of differences between different measures given to the same participant. This may be expressed by such phrases as “repeated measures” or “within-participants factor”. </li>
		<li><b>RMX = combined experimental and repeated-measures effect</b>
			<br>The test has multiple independent variables, at least one of which would be coded “X” and at least one of which would be coded “RM” (that is, a mixed design with both between- and with-participant factors).</li>
		<li><b>Q = quasi- experimental analysis of manipulation effect</b>
			<br>One or more of the test’s independent variables represents different “treatments” given to participants in situations under the researcher’s control, but without being able to assign participants randomly.</li>
	</ol></li>
	<li>Methodology code (use as many as apply, separated by forward slashes)</li>
	<li><ol>
		<li><b>A = archival measures: </b>The analysis includes at least one variable derived from data that are found by the researchers rather than specially collected from participants, such as average school grades of students in different states, text analysis of singles’ ads on the internet.</li>
		<li><b>BI = brain imaging measures:</b> The analysis involves at least one variable derived from fMRI or other spatial brain imaging techniques. (Do not include EEG or other non-spatial brain measurement techniques).</li>
		<li><b>J = judgment measures: </b>The analysis involves at least one variable that is the judgment of participants by other people for a trait that is more general than the participant’s specific behavior or responses (for example, attractiveness ratings from a photo, or personality ratings on the basis of a 5 minute interaction).</li>
		<li><b>P = non-imaging physiological measures</b>: The analysis involves at least one variable derived from physiological measures other than brain imaging; that is, measures taken directly from the human body or its products. Do not include self-reported physiological phenomena such as time of menstrual cycle, hunger, etc.</li>
		<li><i>Some common examples: heart rate, skin conductance, event-related potentials in electrencephalography (EEG), electromyography (EMG), direct analysis of DNA, grip strength, measuring chemicals in blood or saliva, etc. </i></li>
		<li><b>SR = self-report measures:</b> The analysis involves at least one variable assessing the participant’s thoughts, feelings, intentions or behavior using controlled self-report through written, verbal, numeric, or visual analogue measures. This includes variables that are presented as a test of ability with a correct answer (for example, memory or reasoning tests), and choices that the participants believe to have no consequences outside the experimental context (for example, choosing how to allocate money in an explicitly hypothetical task) .</li>
		<li><b>I = indirect verbal or response-time measures:</b> The analysis involves at least one variable assessing the participant’s thoughts, feelings, or intentions with an indirect measure: one that that does not directly measure the participant’s body or brain but is based on analysis of verbal or response-time output, and which is intended to bypass controlled, conscious responding.
			<br><i>Some common examples: an implicit measurement task inferring attitudes from patterns of response times; a projective story task which is then coded for implicit themes; analyzing participant’s free writing for subtle uses of grammar that reveal attitudes toward groups (as opposed to directly expressed attitudes toward groups).</i></li>
		<li><b>BC = behavioral/choice measures:</b> The analysis involves at least one variable that measures the participant’s behavior by observation, or gives the participant a choice that he or she believes to have consequences outside the immediate experimental context.
			<br><i>Some common examples: a gambling task where the participant can win real money (but not a task where everyone is paid the same amount regardless of performance); a choice of whether to interact with another person in the next phase of the experiment, even though the experiment uses deception and the person does not really exist; observations of nonverbal behavior; a choice to give your email address to receive further messages about the environment.</i></li>
	</ol></li>
	<li>Names of any variables that are treated as independent variables(s) in the test, separated by commas. <i>Some examples of independent variables are: categorical variables in an ANOVA or t-test; covariates in an ANCOVA; repeated-measures variables such as “time of testing” or “stimulus type”; moderator in a moderation analysis; predictors in a regression.</i> </li>
	<li>Names of any other variables in the test, including dependent variables, separated by commas. <i>Some examples are: the dependent variable in an ANOVA, t-test or regression; the variables in a correlation or chi-square analysis; the mediator and dependent variable in a mediation analysis.</i></li>
	<li><b>Number of participants or data points excluded from analysis.</b> This should not include data that were genuinely missing (procedural errors, failure to answer, drop-outs from multiple waves of a study), but should include data that the researchers had, but chose to exclude.</li>
	<li><b>Reasons for excluding data</b>, separated by commas if multiple reasons given (using the author’s words as much as possible)</li>
	<li>Type of statistical test used, in the authors’ words (examples: ANCOVA; structural equation model; mediation analysis with bootstrapping)</li>
	<li><b>N of cases used in the analysis</b>, after exclusion (using the authors’ stated units of analysis; usually participants, but maybe other factors if hierarchical analysis is used)</li>
	<li><b>Inferential test statistic and its value</b> (the value of the F-value, t-value, or chi-square associated with the test.) For example: “F = 3.92,” “t = -1.35.” If this is followed by more specific comparisons or contrasts, report here only the statistic for the overall test. <i>Do not report values of r, B or beta from correlations or regressions here</i> because they are better seen as effect size statistics, not inferential test statistics (see 15 below, “Effect size”). Often, significance tests of r, B and beta are reported without an inferential test statistic, which usually should be <i>t</i>. If this is the case, or in other cases where inferential statistics are missing, enter “None reported.”</li>
	<li><b>Degrees of freedom of the inferential statistic</b> (separated by commas if more than one, and giving the N second if a chi-square). “None reported” if these are missing.</li>
	<li><b>Significance of test as reported</b>: If the exact p value is not reported, state the possible range of p values from lowest to highest, “p1 to p2,”, with “~0” as the lowest possible result. If the value is not a p value (for example, p<sub>rep</sub>) this fact should also be entered (so, “p-rep .98”). “None reported” if this is missing.
		<br>Examples:
		<ul>
			<li><i>a value reported only as p &lt; .001 should be reported “~0 to .001” ; </i></li>
			<li><i>“not significant” and nothing else should be reported “.05 to 1” unless a different alpha criterion than .05 is explicitly used; </i></li>
			<li><i>The entry ** in a table where * = p &lt; .05, ** = p &lt; .01, *** = p &lt; .001 should be reported “.001 to .01”</i></li>
		</ul>
	</li>
	<li>(OPTIONAL) <b>Exact p value of the test:</b> if not reported but calculable from the inferential statistics. This is an optional code that may depend on your statistical knowledge. If the test is reported as a straightforward z, t, F or chi-square test the following online p value calculator may be used: <a href="http://graphpad.com/quickcalcs/PValue1.cfm">http://graphpad.com/quickcalcs/PValue1.cfm</a>.</li>
	<li><b>Main result of the test:</b> Stated in terms of the directional relationship between variables, using the same format as you would to express any hypothesis (see effects section 2). If there are nominal variables with more than three levels involved, report the particular comparisons relevant to the effect. </li>
	<li><b>Supports hypotheses of the article?</b> As evaluated by the authors in the Discussion section, does the test provide evidence for their hypotheses that were stated prior to the result? If no relevant hypotheses were stated code “NH”; otherwise, code “Yes”, “No” or “Complex” if the authors find only partial support for the hypotheses.</li>
	<li><b>Effect size of the test as reported:</b> If significance tells you how likely a result is to have arisen by chance sampling from a population where you wouldn’t say the result is true, effect size tells you how strong the effect is, in terms of the ratio of “signal” (for example, difference between means for men and woman) to “noise” (for example, variability in scores.) Enter the effect size statistic and its value.
		<li><ol>
			<li>For some tests, finding effect size statistics is easy. Correlation and regression coefficients (r, R<sup>2</sup>,beta and B) are themselves actually effect size statistics. (Although technically you cannot have a negative effect size, you should leave any minus signs on r, beta and B you report here, to keep clear which direction they go in.)</li>
			<li>t-tests usually report the associated effect size d.</li>
			<li>ANOVA and related procedures have a number of possible effect sizes that can be reported; d, f<sup>2</sup> , h<sup>2</sup>(eta squared), partial h<sup>2</sup>,w<sup> 2 </sup>(omega squared). If an ANOVA’s mean squared error is reported without any effect size stat, report this. Mean square error is not an effect size stat, but will allow it to be computed with the rest of the information about the ANOVA.</li>
			<li>For chi square tests, there is no clearly accepted effect size statistic; phi coefficient or Cramer’s V are sometimes reported but they both have flaws.</li>
			<li>Effect size in SEM is complicated; if hypotheses depend on specific parameters (paths), use the standardized coefficient for that particular path.</li>
			<li>Sometimes effect size is not reported. In that case enter “No ES.”</li>
		</ol></li>
	<li><b>Statistical power of the test</b>, if reported in the article, as a proportion between 0 and 1 (for example, .88). If absent, enter “No power reported.”</li>
</ol>
</section>